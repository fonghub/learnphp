<?php
namespace Cli\Controller;


use Task\Bll\InterviewQuestions\TraversalFile;

use Think\Controller;

class InterviewQuestionsController extends Controller
{
    /**
     * 遍历目录
     */
    public function traversalFile()
    {
        $dir = realpath("./Public");
        $output = [];
        //递归遍历
//        TraversalFile::index($dir,$output);
        //不递归遍历
        TraversalFile::scan($dir,$output);
        print_r($output);
    }

}