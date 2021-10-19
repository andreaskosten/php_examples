<?php

/**
 * Class ImageSaver saves an image uploaded to server from frontend page. Before saving it checks file in accordance with requirements.
 *
 * Example of use:
 * $imageSaver = new ImageSaver(1024 * 1024 * 20, 256, 256);
 * $isFileSaved = $imageSaver->saveImage($_FILES);
 */

class ImageSaver
{
    private int $sizeLimit;
    private int $widthLimit;
    private int $heightLimit;
    
    public function __construct(int $sizeLimit, int $widthLimit, int $heightLimit)
    {
        $this->sizeLimit = $sizeLimit;
        $this->widthLimit = $widthLimit;
        $this->heightLimit = $heightLimit;
    }
    
    /**
     * Check file and save it
     *
     * @param array $files
     *
     * @return bool
     */
    public function saveImage(array $files): bool
    {
        // if size of the file is 0b:
        if ($files['fileName']['size'] === 0) {
            $this->handleError('size of the file is 0b');
            return false;
        }
        
        // if size of the file exceeds provided limit:
        if ($files['fileName']['size'] > $this->sizeLimit) {
            $this->handleError('size of the file exceedes provided limit');
            return false;
        }
        
        // if size of the image has invalid value(-s):
        $arraySizes = getimagesize($files['fileName']['tmp_name']);
        if ($arraySizes[0] <= 0 || $arraySizes[1] <= 0) {
            $this->handleError('size of the image has invalid value(-s)');
            return false;
        }
        
        // if size of the image has oversizing value(-s):
        if ($arraySizes[0] > $this->widthLimit || $arraySizes[1] > $this->heightLimit) {
            $this->handleError('size of the image has oversizing value(-s)');
            return false;
        }
        
        // image must have allowed format:
        $format = $this->getFormat($arraySizes[2]);
        if (!$format) {
            $this->handleError('image has forbidden extension');
            return false;
        }
        
        // at this point we can consider this file as safe image...
        
        // save file:
        $fileName = $this->generateRandomName(10) . '.' . $format;
        if (copy($files['fileName']['tmp_name'], 'images_uploaded/' . $fileName)) {
            return true;
        } else {
            $this->handleError('saving file was not successful');
            return false;
        }
    }
    
    /**
     * Generate random name for file
     *
     * @param int $limit
     *
     * @return string
     */
    private function generateRandomName(int $limit): string
    {
        $now = date('md-His');
        $array = ['A', 'B', 'C', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];
        
        $result = '';
        for ($i = 0; $i < $limit; $i++) {
            $a = array_rand($array);
            $result .= $array[$a];
        }
        $result = $now . '-' . $result;
        return $result;
    }
    
    /**
     * Get name of needed extension, ignore others
     *
     * @param int $num
     *
     * @return string
     */
    private function getFormat(int $num): string
    {
        if ($num === 2) { return 'jpg'; }
        if ($num === 3) { return 'png'; }
        return false;
    }
    
    /**
     * Handle error (write logs, raise and handle exceptions etc.)
     *
     * @param string $text
     */
    private function handleError(string $text): void
    {
        // realization is not so important now...
        exit('todo: function "handleError" needs realization; text = ' . $text);
    }
}
