<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Image;
use App\Http\Requests\ImageRequest;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ImageController extends Controller
{

    public function index(Request $request): View
    {
        $date = $request->get('date', 'desc');
        $name = $request->get('name', 'desc');
        //dd($date, $name);

        $images = Image::orderBy('created_at', $date)
            ->orderBy('filename', $name)
            ->get();

        return view('welcome', compact('images'));
    }

    public function upload(ImageRequest $request): RedirectResponse
    {
        // Валидация входящего запроса, проверка наличия файла 'image'
        $validated = $request->validated();

        // Получение файла из запроса
        if ($request->hasfile('images')) {
            foreach ($validated['images'] as $image) {
                // Транслитерация имени изображения
                $originalName = $image->getClientOriginalName();
                $baseName = pathinfo($originalName, PATHINFO_FILENAME);
                $baseName = Str::slug($baseName, '-');
                // Генерация уникального имени для изображения
                $name =  $baseName . '_' . time() . '.' . $image->getClientOriginalExtension();
                // Сохранение изображения в папку 'public/images'
                $image->storeAs('images', $name, 'public');
                // Сохранение данных о изображении в БД
                $image = new Image();
                $image->filename = $name;
                $image->save();
            }
        }

        return redirect()->route('images.index')->with('success', 'Images uploaded successfully');
    }

    public function downloadZip(int $id): BinaryFileResponse|RedirectResponse
    {
        $image = Image::find($id);
        // Создаем новый экземпляр класса ZipArchive
        $zip = new \ZipArchive();
        // Устанавливаем имя для нашего zip-файла
        $zipFileName = $image->filename . '.zip';
        // Проверяем, может ли ZipArchive открыть наш zip-файл
        if ($zip->open(public_path($zipFileName), \ZipArchive::CREATE) === TRUE) {
            // Добавляем файл в zip-архив
            $zip->addFile(storage_path('app/public/images/' . $image->filename), $image->filename);
            // Закрываем ZipArchive
            $zip->close();
            // Возвращаем zip-файл для скачивания
            return response()->download(public_path($zipFileName))->deleteFileAfterSend(true);
        }

        return redirect()->route('images.index')->with('errors', 'Unable to create zip file.');
    }


}
