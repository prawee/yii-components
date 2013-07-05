<?php

class ThumbnailBehavior extends CBehavior {

    public $thumbnailPath = 'default';
    public $thumbnailsSize = array(
        'sss' => array(24, 24), // confirm
        'ss' => array(70, 70), // confirm
        'sm' => array(120, 120), // confirm //for sipad
        'sl' => array(250, 250), // confirm
        'vs' => array(56, 100),
        'vm' => array(124, 178),//for vipad
        'vl' => array(310, 550),
        'hs' => array(100, 60), // confirm
        'hm' => array(300, 169),
        'hl' => array(550, 310),
        
        '682_490'=>array(682,490),
        '682_308'=>array(682,308),
        '512_288'=>array(512,288),
        '341_238'=>array(341,238),
        '341_202'=>array(341,202),
        '190_190'=>array(190,190),
        '178_256'=>array(178,256),
        '147_98'=>array(147,98),
        '124_178'=>array(124,178),
        
        '130_130'=>array(130,130),
    );

    public function imageResize($file, $w, $h, $scale = 1) {
        $img = Yii::app()->imagemod->load($file);
        $img->image_resize = true;
        $img->image_x = $w;
        $img->image_y = $h;
        $img->image_ratio_crop = true;
        $img->file_overwrite = true;
        $img->process('/tmp/');
        return $img->file_dst_pathname;
        return $tmpfname;
    }

    public function saveThumbnails($attribute) {
        $obj = CUploadedFile::getInstance($this->getOwner(), $attribute);
        if (isset($obj)) {
            $name = isset($this->getOwner()->image_name) ? $this->getOwner()->image_name : md5(uniqid()) . '.' . pathinfo($obj->name, PATHINFO_EXTENSION);
            foreach ($this->thumbnailsSize as $key => $size) {
                $img = Yii::app()->imagemod->load(array(
                    'name' => $obj->name,
                    'type' => $obj->type,
                    'tmp_name' => $obj->tempName,
                    'error' => $obj->error,
                    'size' => $obj->size,
                        ));
                $img->image_resize = true;
                $img->file_new_name_body = pathinfo($name, PATHINFO_FILENAME);
                $img->image_x = $size[0];
                $img->image_y = $size[1];
                $img->image_ratio_crop = true;
                $img->file_overwrite = true;
                $img->process(Yii::app()->assetManager->basePath . '/tmp/');
                Yii::app()->static->put($img->file_dst_pathname, $this->thumbnailPath . DS . $key . DS . $name);
            }
            $this->getOwner()->image_path = $this->thumbnailPath;
            $this->getOwner()->image_name = $name;
        }
    }

    public function saveAdsTypeImage($attribute) {
        $obj = CUploadedFile::getInstance($this->getOwner(), $attribute);
        if (isset($obj)) {
            $name = isset($this->getOwner()->image_name) ? $this->getOwner()->image_name : md5(uniqid()) . '.' . pathinfo($obj->name, PATHINFO_EXTENSION);
            foreach ($this->thumbnailsSize as $key => $size) {
                $img = Yii::app()->imagemod->load(array(
                    'name' => $obj->name,
                    'type' => $obj->type,
                    'tmp_name' => $obj->tempName,
                    'error' => $obj->error,
                    'size' => $obj->size,
                        ));
                $img->image_resize = true;
                $img->file_new_name_body = pathinfo($name, PATHINFO_FILENAME);
                $img->image_x = $size[0];
                $img->image_y = $size[1];
                $img->image_ratio_crop = true;
                $img->file_overwrite = true;
                $img->process(Yii::app()->assetManager->basePath . '/tmp/');
                Yii::app()->static->put($img->file_dst_pathname, $this->thumbnailPath . DS . $key . DS . $name);

            }
            
            $key = "default";
            $img = Yii::app()->imagemod->load(array(
                'name' => $obj->name,
                'type' => $obj->type,
                'tmp_name' => $obj->tempName,
                'error' => $obj->error,
                'size' => $obj->size,
                    ));
            $img->image_resize = false;
            $img->file_new_name_body = pathinfo($name, PATHINFO_FILENAME);
            $img->image_ratio_crop = false;
            $img->file_overwrite = true;
            $img->process(Yii::app()->assetManager->basePath . '/tmp/');
            Yii::app()->static->put($img->file_dst_pathname, $this->thumbnailPath . DS . $key . DS . $name);

            
            $this->getOwner()->image_path = $this->thumbnailPath;
            $this->getOwner()->image_name = $name;
        }
    }

    public function saveThumbnailSetSize($attribute, $size = array(170, 170), $sizefolder = 'tmp') {
        $obj = CUploadedFile::getInstance($this->getOwner(), $attribute);
        if (isset($obj)) {
            $name = isset($this->getOwner()->image_name) ? $this->getOwner()->image_name : md5(uniqid()) . '.' . pathinfo($obj->name, PATHINFO_EXTENSION);
            $img = Yii::app()->imagemod->load(array(
                'name' => $obj->name,
                'type' => $obj->type,
                'tmp_name' => $obj->tempName,
                'error' => $obj->error,
                'size' => $obj->size,
                    ));
            $img->image_resize = true;
            $img->file_new_name_body = pathinfo($name, PATHINFO_FILENAME);
            $img->image_x = $size[0];
            $img->image_y = $size[1];
            $img->image_ratio_crop = true;
            $img->file_overwrite = true;
            $img->process(Yii::app()->assetManager->basePath . '/tmp/');           
            Yii::app()->static->put($img->file_dst_pathname, $this->thumbnailPath . DS . $sizefolder . DS . $name);
            $sizefolder = 'ss';
            $size = $this->thumbnailsSize[$sizefolder];
            $img = Yii::app()->imagemod->load(array(
                'name' => $obj->name,
                'type' => $obj->type,
                'tmp_name' => $obj->tempName,
                'error' => $obj->error,
                'size' => $obj->size,
                    ));
            $img->image_resize = true;
            $img->file_new_name_body = pathinfo($name, PATHINFO_FILENAME);
            $img->image_x = $size[0];
            $img->image_y = $size[1];
            $img->image_ratio_crop = true;
            $img->file_overwrite = true;
            $img->process(Yii::app()->assetManager->basePath . '/tmp/');
            Yii::app()->static->put($img->file_dst_pathname, $this->thumbnailPath . DS . $sizefolder . DS . $name);

            $this->getOwner()->image_path = $this->thumbnailPath;
            $this->getOwner()->image_name = $name;
        }
    }

    public function setThumbnails($file) {
        if (!isset($file)) {
            return;
        }

        $filename = $this->createUniqueFilename($file->name);
        $this->getOwner()->image_name = $filename;
        $this->getOwner()->image_path = $this->createStaticPath($this->thumbnailPath);

        foreach ($this->getThumbnailSize() as $key => $size) {
            $img = Yii::app()->imagemod->load(array(
                'name' => $file->name,
                'type' => $file->type,
                'tmp_name' => $file->tempName,
                'error' => $file->error,
                'size' => $file->size,
                    ));
            $img->image_resize = true;
            $img->file_new_name_body = pathinfo($this->getOwner()->image_name, PATHINFO_FILENAME);
            $img->image_x = $size[0];
            $img->image_y = $size[1];
            $img->image_ratio_crop = true;
            $img->file_overwrite = true;
            $img->process('/tmp/');
            $this->getOwner()->setThumbnail($img->file_dst_pathname, $key);
        }
    }

    public function setImages($file) {
        if (is_array($file)) {
            foreach ($file as $image_name) {
                $size = "default";
                Yii::app()->static->put(Yii::app()->assetManager->basePath . '/tmp/' . $image_name, $this->getOwner()->image_path . DS . $size . DS . $image_name); //upload to static server
                unlink(Yii::app()->assetManager->basePath . '/tmp/' . $image_name); //delete tmp image file
            }
        }
    }

    public function setThumbnailNine() {
        $sizeA = array(
            /*'sl' => 'sm',
            'sm' => 'sm',
            'ss' => 'sm',
            'sss' => 'sm',
            'hl' => 'hm',
            'hm' => 'hm',
            'hs' => 'hm',
            'vl' => 'vm',
            'vm' => 'vm',
            'vs' => 'vm',*/
            'sm'=>'sm',
            //mobile
            '682_490'=>'682_490',
            '682_308'=>'682_308',
            '512_288'=>'512_288',
            '341_238'=>'341_238',
            '341_202'=>'341_202',
            '190_190'=>'190_190',
            '178_256'=>'178_256',
            '147_98'=>'147_98',
            '124_178'=>'124_178',
        );
        foreach ($sizeA as $key => $value) {
            $img = Yii::app()->imagemod->load(Yii::app()->assetManager->basePath . '/tmp/' . $this->owner->image_name);
            $img->file_overwrite = true;
            $img->file_auto_rename = false;
            $img->image_resize = true;
            $img->image_precrop = array(
                $_POST[$value . 'cropY'],
                $img->image_src_x - ($_POST[$value . 'cropX'] + $_POST[$value . 'cropW']),
                $img->image_src_y - ($_POST[$value . 'cropY'] + $_POST[$value . 'cropH']),
                $_POST[$value . 'cropX']
            );
            $img->image_x = $this->owner->getThumbnailSize($key, 'x');
            $img->image_y = $this->owner->getThumbnailSize($key, 'y');
            $img->image_convert = pathinfo($this->owner->image_name, PATHINFO_EXTENSION);
            $img->process(Yii::app()->assetManager->basePath . '/tmp/crop/');
            $this->owner->setThumbnail($img->file_dst_pathname, $key);
        }
    }
    public function setThumbnailTen() {
        $sizeA = array(
            'sm'=>'sm',
            'ss'=>'ss',
            '682_490'=>'682_490',
            '682_308'=>'682_308',
            '512_288'=>'512_288',
            '341_238'=>'341_238',
            '341_202'=>'341_202',
            '190_190'=>'190_190',
            '178_256'=>'178_256',
            '147_98'=>'147_98',
            '124_178'=>'124_178',
            '130_130'=>'130_130',
        );
        foreach ($sizeA as $key => $value) {
            $path=Yii::app()->assetManager->basePath . '/tmp/' .$value.$this->owner->image_name;
            if(!file_exists($path)){
                $path=Yii::app()->assetManager->basePath . '/tmp/'.'df'.$this->owner->image_name;
            }
            $img = Yii::app()->imagemod->load($path);
            $img->file_overwrite = true;
            $img->file_auto_rename = false;
            $img->image_resize = true;
            $img->image_precrop = array(
                $_POST[$value . 'cropY'],
                $img->image_src_x - ($_POST[$value . 'cropX'] + $_POST[$value . 'cropW']),
                $img->image_src_y - ($_POST[$value . 'cropY'] + $_POST[$value . 'cropH']),
                $_POST[$value . 'cropX']
            );
            $img->image_x = $this->owner->getThumbnailSize($key, 'x');
            $img->image_y = $this->owner->getThumbnailSize($key, 'y');
            $img->image_convert = pathinfo($this->owner->image_name, PATHINFO_EXTENSION);
            $img->process(Yii::app()->assetManager->basePath . '/tmp/crop/');
            $this->owner->setThumbnail($img->file_dst_pathname, $key);
        }
    }

    public function getThumbnail($size = 'ss') {

        if (isset($this->owner->image_name)) {
            $img = Yii::app()->static->url . $this->owner->image_path . '/' . $size . '/' . $this->owner->image_name;
            $imageInfo = @getimagesize($img);
            if(is_array($imageInfo)){
                return $img . '?' . date('YmdHisu');
            }
        }

        if (isset($this->thumbnailsSize[$size])) {
            $coor = $this->thumbnailsSize[$size];
        } else {
            $coor = $this->thumbnailsSize['sss'];
        }
        return 'http://placehold.it/' . $coor[0] . 'x' . $coor[1];
    }

    public function getThumbnailSize($key = null, $getSide = null) {
        if (isset($key)) {
            if (isset($this->thumbnailsSize[$key])) {
                if (isset($getSide)) {
                    switch ($getSide) {
                        case 'x':
                            return $this->thumbnailsSize[$key][0];
                        case 'y':
                            return $this->thumbnailsSize[$key][1];
                        default:
                            return $this->thumbnailsSize[$key];
                    }
                } else {
                    return $this->thumbnailsSize[$key];
                }
            }
        } else {
            return $this->thumbnailsSize;
        }
        return $this->thumbnailsSize['square'];
    }

    public function setThumbnail($file, $size) {
        if (isset($this->getOwner()->image_path)) {
            if ($this->getOwner()->image_name) {
                Yii::app()->static->delete($this->getOwner()->image_path . DS . $size . DS . $this->getOwner()->image_name);
            }
        } else {
            $this->getOwner()->image_path = $this->createStaticPath($this->thumbnailPath);
        }

        Yii::app()->static->put($file, $this->getOwner()->image_path . DS . $size . DS . $this->getOwner()->image_name);
    }

    public function createStaticPath($type = '') {
        if (is_array($type)) {
            $type = implode(DS, $type);
        }
        return DS . 'ch' . DS . Yii::app()->user->channel->id . DS . $type;
    }

    public function createUniqueFilename($file = '') {
        $info = pathinfo($file);
        return uniqid() . '.' . strtolower($info['extension']);
    }

}

?>
