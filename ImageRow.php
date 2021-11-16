<?php
class ImageRow{
    public $id;
    public $action;
    public $name;
    public $fileCreateTime;
    public $image;

    public function __construct($id, $image){
        $this->id = $id;
        $this->action = "<span class='ban-button' data-id='$id'>x</span>";
        $this->name = exif_read_data($image, 0, true)["IFD0"]["ImageDescription"];
        $this->fileCreateTime = date("F d Y H:i:s.", filectime($image));
        $this->image = " <a href='$image'> <img src='$image' alt='' class='image' data-id='$id'></a>";
    }

    public static function toString($row){
        return "<div class='row simple-row align-items-center ' data-id='$row->id'>

        <div class='col'> $row->id</div>
              <div class='col'>$row->action</div> 
              <div class='col'>$row->name</div>
              <div class='col'> $row->fileCreateTime</div>
              <div class='col'>
                $row->image
              </div>

        </div>";
    }
}
