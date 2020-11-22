<?php
require_once 'IDisplayable.php';
require_once 'AbstractDisplayable.php';
class ViewSite extends AbstractDisplayable implements IDisplayable {
    var $data;
    public function  __construct($data,$child) {
        $this->data = $data;
        $this->child = $child;
        //$this->subElements = [];
    }

    public function displayElement(){
        $this->displayStart();
        $this->displayBodyStart();
        $this->displayBodyContent();
        $this->displayBodyEnd();
        $this->displayEnd();
    }

    public function displayStart(){
        echo "<html lang=\"en\">
        <head>
            <title>Thread</title>
            <link rel=\"stylesheet\" href=\"style.css\">
        </head>";
    }

    public function displayEnd(){
        echo "</html>";
    }

    public function displayBodyStart(){
        echo "<nav>
        <h2 class=\"main_heading\">Gaming Community</h2>
        <ul class=\"top_links\">
            <li class=\"top_link\"><a href=\"index.html\">Home</a></li>
            <li class=\"top_link\"><a class=\"current\" href=\"forums.html\">Forums</a></li>
        </ul>
        </nav>";
    }

    public function displayBodyContent(){
        if ($this->child != false){
            $this->child->displayElement();
        }
    }

    public function displayBodyEnd(){
        echo "</form>
        </main>";
    }
}
//$viewSite = new ViewSite(false,false);
//$viewSite->displayElement();