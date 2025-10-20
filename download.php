<?php
// Принудительное скачивание MP3 файлов
if(isset($_GET['file'])) {
    $file = basename($_GET['file']); // Безопасность
    $filepath = __DIR__ . '/' . $file;
    
    if(file_exists($filepath)) {
        // Устанавливаем заголовки для принудительного скачивания
        header('Content-Description: File Transfer');
        header('Content-Type: audio/mpeg');
        header('Content-Disposition: attachment; filename="' . $file . '"');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        
        // Очищаем буфер вывода
        ob_clean();
        flush();
        
        // Отправляем файл
        readfile($filepath);
        exit;
    } else {
        header("HTTP/1.0 404 Not Found");
        echo "Файл не найден";
    }
} else {
    header("HTTP/1.0 400 Bad Request");
    echo "Не указан файл";
}
?>
