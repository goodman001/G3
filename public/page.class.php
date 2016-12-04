<?php  
  
/* * *********************************************  
 * @class:   page  
 * @para:   $myde_total - total num 
 *          $myde_size - num/page  
 *          $myde_page - current page  
 *          $myde_url - current url  
 */  
  
class page {  
  
    private $myde_total;          
    private $myde_size;           
    private $myde_page;             
    private $myde_page_count;     //total page num  
    private $myde_i;              //start page 
    private $myde_en;             //end page
    private $myde_url;            //  
    /*  
     * $show_pages  
     * 页面显示的格式，显示链接的页数为2*$show_pages+1。  
     * how_pages=2 [start] [pre] 1 2 3 4 5 [next] [end]   
     */  
    private $show_pages;  
  
    public function __construct($myde_total = 1, $myde_size = 1, $myde_page = 1, $myde_url, $show_pages = 2) {  
        $this->myde_total = $this->numeric($myde_total);  
        $this->myde_size = $this->numeric($myde_size);  
        $this->myde_page = $this->numeric($myde_page);  
        $this->myde_page_count = ceil($this->myde_total / $this->myde_size);  
        $this->myde_url = $myde_url;  
        if ($this->myde_total < 0)  
            $this->myde_total = 0;  
        if ($this->myde_page < 1)  
            $this->myde_page = 1;  
        if ($this->myde_page_count < 1)  
            $this->myde_page_count = 1;  
        if ($this->myde_page > $this->myde_page_count)  
            $this->myde_page = $this->myde_page_count;  
        $this->limit = ($this->myde_page - 1) * $this->myde_size;  
        $this->myde_i = $this->myde_page - $show_pages;  
        $this->myde_en = $this->myde_page + $show_pages;  
        if ($this->myde_i < 1) {  
            $this->myde_en = $this->myde_en + (1 - $this->myde_i);  
            $this->myde_i = 1;  
        }  
        if ($this->myde_en > $this->myde_page_count) {  
            $this->myde_i = $this->myde_i - ($this->myde_en - $this->myde_page_count);  
            $this->myde_en = $this->myde_page_count;  
        }  
        if ($this->myde_i < 1)  
            $this->myde_i = 1;  
    }  
  
    //check whether is number 
    private function numeric($num) {  
        if (strlen($num)) {  
            if (!preg_match("/^[0-9]+$/", $num)) {  
                $num = 1;  
            } else {  
                $num = substr($num, 0, 11);  
            }  
        } else {  
            $num = 1;  
        }  
        return $num;  
    }  
  
    //replace page 
    private function page_replace($page) {  
        return str_replace("{page}", $page, $this->myde_url);  
    }  
  
    //start page 
    private function myde_home() {  
        if ($this->myde_page != 1) {  
            return "<a href='" . $this->page_replace(1) . "' title='start'>start</a>";  
        } else {  
            return "<p>start</p>";  
        }  
    }  
  
    //per  
    private function myde_prev() {  
        if ($this->myde_page != 1) {  
            return "<a href='" . $this->page_replace($this->myde_page - 1) . "' title='pre'>pre</a>";  
        } else {  
            return "<p>pre</p>";  
        }  
    }  
  
    //last
    private function myde_next() {  
        if ($this->myde_page != $this->myde_page_count) {  
            return "<a href='" . $this->page_replace($this->myde_page + 1) . "' title='last'>last</a>";  
        } else {  
            return"<p>last</p>";  
        }  
    }  
  
    //end 
    private function myde_last() {  
        if ($this->myde_page != $this->myde_page_count) {  
            return "<a href='" . $this->page_replace($this->myde_page_count) . "' title='end'>end</a>";  
        } else {  
            return "<p>end</p>";  
        }  
    }  
  
    //output  
    public function myde_write($id = 'page') {  
        $str = "<div id=" . $id . ">";  
        $str.=$this->myde_home();  
        $str.=$this->myde_prev();  
        if ($this->myde_i > 1) {  
            $str.="<p class='pageEllipsis'>...</p>";  
        }  
        for ($i = $this->myde_i; $i <= $this->myde_en; $i++) {  
            if ($i == $this->myde_page) {  
                $str.="<a href='" . $this->page_replace($i) . "' title='page" . $i . "' class='cur'>$i</a>";  
            } else {  
                $str.="<a href='" . $this->page_replace($i) . "' title='page" . $i . "'>$i</a>";  
            }  
        }  
        if ($this->myde_en < $this->myde_page_count) {  
            $str.="<p class='pageEllipsis'>...</p>";  
        }  
        $str.=$this->myde_next();  
        $str.=$this->myde_last(); 
		$str.="<p class='pageRemark'>Totalpage:<b> " . $this->myde_page_count .  
                " </b>page ; Totalnum:<b> " . $this->myde_total . "</b> images </p>";  
        $str.="</div>";  
        return $str;  
    }  
  
}  
  
?>  