<?php
namespace Live\Collection;

/**
 * File collection
 *
 * @package Live\Collection
 */
class FileCollection extends MemoryCollection
{
    /**
     * Collection file path
     *
     * @var string
     */
    protected $file_path;

    //gives the filename **optional**
    public function __construct($filename = 'default_file.txt')
    {
        $this->file_path = __DIR__ . DIRECTORY_SEPARATOR . 'storaged_data' . DIRECTORY_SEPARATOR . $filename;
        \file_put_contents($this->file_path, '');
    }

    /**
     * {@inheritDoc}
     */
    public function write()
    {
        try {
            $has_first_line_on_file = fgets(fopen($this->file_path, 'r+'), 65535) == null;
            $include_comma = $has_first_line_on_file ? '' : ',';
            fwrite(fopen($this->file_path, 'r+'), json_encode($this->data));
            return true;
        } catch (Exception $e) {
            var_dump($e->getMessage());
            return false;
        }
    }
    /**
    * {@inheritDoc}
    */
    public function read()
    {
        try {
            //code...
            $result = file_get_contents($this->file_path);
            $result = json_decode($result, true);
            $this->data = $result;
            return $this->data;
        } catch (\Exception $e) {
            //throw $th;
            return [];
        }
    }
}
