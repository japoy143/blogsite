
<?php

class Introduction
{
    public $id;
    public $Title;
    public $Category;
    public $Img;
    public $Body;

    public function __construct(int $id, string $Title, string $Category,  string $Img, string $Body)
    {
        $this->id = $id;
        $this->Title = $Title;
        $this->Category = $Category;
        $this->Img = $Img;
        $this->Body = $Body;
    }

    public function getTitle()
    {
        return $this->Category;
    }
}


class Header
{
    public $id;
    public $Header;

    public function __construct(int $id, string $Header)
    {
        $this->id = $id;
        $this->Header = $Header;
    }
}


class Paragraph
{
    public $id;
    public $Paragraph;

    public function __construct(int $id, string $Paragraph)
    {
        $this->id = $id;
        $this->Paragraph = $Paragraph;
    }
}


class Image
{
    public $id;
    public $Image;

    public function __construct(int $id, string $Image)
    {
        $this->id = $id;
        $this->Image = $Image;
    }
}


class Section
{
    public $id;
    public $SectionTitle;
    public $Image;
    public $Paragraph;

    public function __construct(int $id, string $SectionTitle, string $Image, string $Paragraph)
    {
        $this->id = $id;
        $this->SectionTitle = $SectionTitle;
        $this->Image = $Image;
        $this->Paragraph = $Paragraph;
    }
}



?>