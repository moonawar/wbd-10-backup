<?
class BookModel { 
    private $db;

    public function __construct(Db $db)
    {
        $this->db = $db; 
    }

    public function addBook(
        string $title, int $year, string $summary, int $price, int $duration, string $lang
    ) {
        if ($summary == null) { 
            $summary = '-';
        }

        $sql = "INSERT INTO book (title, year, summary, price, duration, lang) 
            VALUES ('$title', '$year', '$summary', '$price', '$duration', '$lang')";

        return $this->db->insertRecord($sql);
    }
}
?>