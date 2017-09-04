<?php
/**
*图片上传
*/
namespace jy_admin\Controller;
defined('THINK_PATH') or exit;
use Think\Controller;
class FileuploadController extends Controller {

    public function index(){
        if ( !isset($_FILES['file']['name']) ){
            die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "没有文件"}, "id" : "id"}');
            die;
        }

        $filename = iconv('UTF-8', 'GBK', $_FILES['file']['name']);

        if ($filename) {

            //文件大小超过200k
        // 	if ($_FILES['file']['size'] > 1024 * 200){
        // 	    echo '-3';
        // 	    die;
        // 	}

            //以时间为目录名定义文件夹目录
            $filepath = 'Uploads/image/'.date('Y').'/'.date('m').'/'.date('d');
            //以时间为目录名创建多层目录文件夹
            $result = !file_exists($filepath)?mkdir($filepath,0777,true):true;
            if (!$result){		//创建目录失败
                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "创建目录失败"}, "id" : "id"}');
            }
            $sTempFileName = $filepath.'/'.md5($filename.time().mt_rand(1, 10000) );

            // move uploaded file into cache folder
            move_uploaded_file ( $_FILES ['file'] ['tmp_name'], $sTempFileName );

            $size = getimagesize($sTempFileName);
            $iWidth = $width = $size[0];
            $iHeight = $height = $size[1];


            $iJpgQuality = 90;

            @chmod ( $sTempFileName, 0644 );

            if (file_exists ( $sTempFileName ) && filesize ( $sTempFileName ) > 0) {
                $aSize = getimagesize ( $sTempFileName ); // try to obtain image info
                if (! $aSize) {
                    @unlink ( $sTempFileName );
                    return;
                }

                // check for image type
                switch ($aSize [2]) {
                    case IMAGETYPE_JPEG :
                        $sExt = '.jpg';
                        $vImg = @imagecreatefromjpeg ( $sTempFileName );
                        break;
                    case IMAGETYPE_PNG :
                        $sExt = '.png';
                        $vImg = @imagecreatefrompng ( $sTempFileName );
                        break;
                    case IMAGETYPE_GIF :
                        $sExt = '.gif';
                        break;
                    default :
                        @unlink ( $sTempFileName );
                        return;
                }
                imagesavealpha($vImg,true);
                if ($sExt == '.gif'){
                    // define a result image filename
                    $sResultFileName = $sTempFileName . $sExt;
                    rename($sTempFileName, $sResultFileName);
                }else {
                    // create a new true color image
                    $vDstImg = @imagecreatetruecolor ( $iWidth, $iHeight );
                    imagealphablending($vDstImg,false);//这里很重要,意思是不合并颜色,直接用$img图像颜色替换,包括透明色;
                    imagesavealpha($vDstImg,true);//这里很重要,意思是不要丢了$thumb图像的透明色;
                    // copy and resize part of an image with resampling
                    imagecopyresampled ( $vDstImg, $vImg, 0, 0, 0, 0, $iWidth, $iHeight, ( int )$width, ( int )$height );
                    // define a result image filename
                    $sResultFileName = $sTempFileName . $sExt;

                    // output image to file
                    imagejpeg ( $vDstImg, $sResultFileName, $iJpgQuality );
                }
                @unlink ( $sTempFileName );
            }

        }

        // Return Success JSON-RPC response
        die('{"jsonrpc" : "2.0", "result" : null, "id" : "id", "pic" : "'.$sResultFileName.'"}');
            }

}