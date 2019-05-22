<?php


namespace Home\Controller;


use Think\Controller;
use Think\Upload;

class UploadController extends Controller
{

    public function index()
    {
        $index = 'index';
        $this->assign(get_defined_vars());
        $this->display();
    }

    public function uploadImg($type = 'image')
    {
        if (IS_POST) {
            $config = $this->getConfigByType($type);
            $this->handleUpload($config);
        }
    }

    public function handleUpload($config)
    {
        $setting = array(
            'maxSize' => $config['maxSize'] * 1024, //上传的文件大小限制 (0-不做限制)
            'exts' => $config['exts_back'], //允许上传的文件后缀
            'autoSub' => true, //自动子目录保存文件
            'subName' => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
            'rootPath' => './Uploads/', //保存根路径
        );

        $objUpload = new Upload($setting);
        $info = $objUpload->upload();
        print_r($info);
    }

    /**
     * 获取配置
     */
    private function getConfigByType($type)
    {
        if ($type == 'image') {
            return array(
                'exts_front' => '*.jpg;*.jpeg;*.png;*.gif;',
                'exts_back' => 'jpg,jpeg,png,gif',
                'maxSize' => 2 * 1024,//kb
                'tips' => '请选择图片文件上传'
            );
        } else if ($type == 'image-jpg') {
            return array(
                'exts_front' => '*.jpg;',
                'exts_back' => 'jpg',
                'maxSize' => 2 * 1024, //kb
                'tips' => '请选择jpg图片文件上传'
            );
        } else if ($type == 'image-png') {
            return array(
                'exts_front' => '*.png;',
                'exts_back' => 'png',
                'maxSize' => 2 * 1024, //kb
                'tips' => '请选择png图片文件上传'
            );
        } else if ($type == 'vedio') {
            return array(
                'exts_front' => '*.mp4;',
                'exts_back' => 'mp4',
                'maxSize' => 20 * 1024, //kb
                'tips' => '请选择视频文件上传'
            );
        } else if ($type == 'asset') {
            return array(
                'exts_front' => '*.assetbundle;',
                'exts_back' => 'assetbundle',
                'maxSize' => 20 * 1024, //kb
                'tips' => '请选择Assetbundle文件上传'
            );
        } else if ($type == 'dat') {
            return array(
                'exts_front' => '*.dat;',
                'exts_back' => 'dat',
                'maxSize' => 20 * 1024, //kb
                'tips' => '请选择dat文件上传'
            );
        } else if ($type == 'xml') {
            return array(
                'exts_front' => '*.xml;',
                'exts_back' => 'xml',
                'maxSize' => 2 * 1024, //kb
                'tips' => '请选择xml文件上传'
            );
        }
        return null;
    }

    public function encode_img()
    {
        $img = "/Uploads/platform/5cde6c326e9ce.png";
        $img1 = "{$_SERVER['DOCUMENT_ROOT']}{$img}";
        $image_info = getimagesize($img1);
        $res = fopen($img1,'r');
        $img_data = fread($res,filesize($img1));
        $img_data_chunk = chunk_split(base64_encode($img_data));
        $img_data_base64 = "data:".$image_info['mime'].";base64,".$img_data_chunk;
        $filename = "{$_SERVER['DOCUMENT_ROOT']}/Uploads/platform/5cde6c326e9ce";
        $res1 = fopen($filename,'w');
        fwrite($res1,$img_data_base64);
        fclose($res);
        fclose($res1);
    }

    public function decode_img()
    {
        $file = "/Uploads/platform/5cde6c326e9ce";
        $file1 = "{$_SERVER['DOCUMENT_ROOT']}{$file}";
        $res = fopen($file1,'r');
        $origin_data = fread($res,filesize($file1));
        $origin_data_arr = explode(',',$origin_data);
        $encode_data = $origin_data_arr[1];
        $img_data = base64_decode($encode_data);
        $img = "/Uploads/platform/5cde6c326e9ce_1.png";
        $img1 = "{$_SERVER['DOCUMENT_ROOT']}{$img}";
        $res1 = fopen($img1,'w');
        $int = fwrite($res1,$img_data);
        echo $int;
        fclose($res);
        fclose($res1);
    }
}