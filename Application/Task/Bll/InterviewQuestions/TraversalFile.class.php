<?php
namespace Task\Bll\InterviewQuestions;

/**
 * 遍历文件
 */
class TraversalFile
{

    /*
     * 递归遍历指定目录下的文件
     */
    public static function index($dir,&$file_array)
    {
        //是一个目录
        if (is_dir($dir)){
            //可以打开
            if ($handle = opendir($dir)){
                //有文件
                while (($file = readdir($handle)) !== false){
                    if ($file != '.' && $file != '..'){
                        $subFile = $dir.'/'.$file;
                        if (is_dir($subFile)){
                            self::index($subFile,$file_array);
                        }else{
                            $file_array[] = $subFile;
                        }
                    }
                }
                closedir($handle);
            }
        }
    }

    /*
     * 遍历指定目录下的文件和目录（不递归）
     */
    public static function scan($dir,&$file_array)
    {
        if (is_dir($dir)){
            $file_array = scandir($dir);
        }
    }

}