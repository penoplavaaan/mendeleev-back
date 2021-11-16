<?php
class ImageGallery{
    private $directory;
    private array $images;
    private int $sectionNumber;
    private int $numberOfImagesOnPage = 3;


    function __construct($path, $viewAll = false, $currentpage = 1){
        $this->directory= glob($path . "/*.jpg");
        $this->sectionNumber = $currentpage;
        $this->images = $viewAll? $this->readAllImages() : $this->readImages($this->sectionNumber);
    }

    private function readAllImages() : array{
        $images = [];
        foreach ($this->directory as $id=>$image){
            array_push($images, new ImageObject($image, $id));
        }
        return $images;
    }

    private function readImages($currentPage, $numberOfImagesOnPage = 3){
        $images = [];

        for ($i = ($currentPage-1)*$numberOfImagesOnPage; $i<$currentPage*$numberOfImagesOnPage;$i ++){
            if($i < count($this->directory)){
                $image = $this->directory[$i];
                array_push($images, new ImageObject($image, $i));
            }

        }
        return $images;
    }

    public function printTable($readImages=false){
        $tableHead = '
            <table class="table table-dark table-hover align-middle">
            <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Удалить</th>
                  <th scope="col">Дата создания</th>
                  <th scope="col">Картинка</th>
                </tr>
            </thead>
            <tbody>';

        $tableBody = "";
        $tableTrail = '</tbody></table>';

        if(!$readImages){
            foreach ($this->images as $image){
                $tableBody.='<tr><th scope="row" >'.($image->id +1).'</th><td><button  class="btn btn-light" onclick="deleteImage(\''.$image->src.'\')"/>Удалить элемент</button></td><td>'.$image->imageCreateTime.'</td><td><a target="_blank" href="'.$image->src.'"><img class="image" src="'.$image->src.'" alt=""></a></td></tr>';
            }
        }

        $numberOfPages = count($this->directory)%$this->numberOfImagesOnPage == 0 ? count($this->directory)/$this->numberOfImagesOnPage : intdiv(count($this->directory), $this->numberOfImagesOnPage) +1;//intdiv(count($this->directory), $this->numberOfImagesOnPage) + count($this->directory)%$this->numberOfImagesOnPage;
        $pagination = "";
        $paginationArr = [];
        for ($i=0; $i<$numberOfPages; $i++){
            array_push($paginationArr, ($i+1));
        }

        foreach ($paginationArr as $page){
            $pagination.="<button class='pageManipulator btn btn-outline-secondary' id='bttn-".$page."' onclick='changePage(\"".$page."\")'>".$page."</button>";
        }

       echo ($tableHead.$tableBody.$tableTrail.$pagination);
        return ($tableHead.$tableBody.$tableTrail.$pagination);
    }
}

class ImageObject
{
    public int $id;
    public  string $src;
    public string $name;
    public string $imageCreateTime;

    private $arr = [
        'января',
        'февраля',
        'марта',
        'апреля',
        'мая',
        'июня',
        'июля',
        'августа',
        'сентября',
        'октября',
        'ноября',
        'декабря'
    ];



    function __construct($image, $id){
        $month = date('n', filectime($image))-1;
        $this->id = $id;
        $this->src = $image;
        $this->imageCreateTime = date("d", filectime($image))." ".$this->arr[$month]." ".date("Y H:i:s.", filectime($image));
        $this->name = exif_read_data($image, 0, true)["IFD0"]["ImageDescription"];
    }
}



