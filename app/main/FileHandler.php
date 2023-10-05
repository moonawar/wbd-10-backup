<?
class FileHandler {
    public function saveImageTo($img, string $id, string $path) {
        $type = mime_content_type($img);
        if (!in_array($type, array_keys(ALLOWED_IMAGES))) {
            throw new RequestException('Unsupported Media Type', 415);
        }

        $ext = ALLOWED_IMAGES[$type];
        
        $file_path = $path . $id . $ext;
        $avail =  !file_exists($file_path);

        while (!$avail) {
            $id = str_shuffle($id);
            $file_path = $path . $id . $ext;
            $avail = !file_exists($file_path);
        }

        // error_log($img);
        // error_log($file_path);
        $success = move_uploaded_file($img, $file_path);
        if (!$success) {
            throw new RequestException('Internal Server Error', 500);
        }

        return $file_path;
    }

    public function saveAudioTo($audio, string $id, string $path) {      
        $type = mime_content_type($audio);
        if (!in_array($type, array_keys(ALLOWED_AUDIOS))) {
            throw new RequestException('Unsupported Media Type', 415);
        }

        $ext = ALLOWED_AUDIOS[$type];
        
        $file_path = $path . $id . $ext;
        $avail =  !file_exists($file_path);

        while (!$avail) {
            $id = str_shuffle($id);
            $file_path = $path . $id . $ext;
            $avail = !file_exists($file_path);
        }

        $success = move_uploaded_file($audio, $file_path);
        if (!$success) {
            throw new RequestException('Internal Server Error', 500);
        }

        return $file_path;
    }

    public function delete($file_path) {
        if (!file_exists($file_path)) return;
        $success = unlink($file_path);
        if (!$success) {
            throw new RequestException('Internal Server Error', 500);
        }
    }

    public function getAudioDuration($audio) {
        $dur = shell_exec("ffmpeg -i " . $audio . " 2>&1");
        if (preg_match("/: Invalid /", $dur)) {
            return false;
        }
        
        preg_match("/Duration: (.{2}):(.{2}):(.{2})/", $dur, $duration);
        if (!isset($duration[1])) {
            return false;
        }

        $hours = $duration[1];
        $minutes = $duration[2];
        $seconds = $duration[3];
        return $seconds + ($minutes * 60) + ($hours * 60 * 60);
    }
}
?>