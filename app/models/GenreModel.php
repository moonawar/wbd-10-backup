<?
class GenreModel {
    private $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function createGenre($name)
    {
        $sql = "INSERT INTO genre (name) VALUES (?)";
        $stmt = $this->db->prepare($sql);
        $this->db->bindParams($stmt, "s", $name);
        return $this->db->execute($stmt);
    }

    public function getGenreByName($name)
    {
        $sql = "SELECT * FROM genre WHERE name = ?";
        $stmt = $this->db->prepare($sql);
        $this->db->bindParams($stmt, "s", $name);
        $result = $this->db->execute($stmt);
        return $this->db->getSingleRecord($stmt);
    }

    public function getAllGenres()
    {
        $sql = "SELECT * FROM genre";
        $stmt = $this->db->prepare($sql);
        return $this->db->getAllRecords($stmt);
    }

    public function deleteGenre($genreId)
    {
        $sql = "DELETE FROM genre WHERE genre_id = ?";
        $stmt = $this->db->prepare($sql);
        $this->db->bindParams($stmt, "i", $genreId);
        return $this->db->execute($stmt);
    }

    public function updateGenre($genreId, $name)
    {
        $sql = "UPDATE genre SET name = ? WHERE genre_id = ?";
        $stmt = $this->db->prepare($sql);
        $this->db->bindParams($stmt, "si", $name, $genreId);
        return $this->db->execute($stmt);
    }

    public function getGenreById($genreId)
    {
        $sql = "SELECT * FROM genre WHERE genre_id = ?";
        $stmt = $this->db->prepare($sql);
        $this->db->bindParams($stmt, "i", $genreId);
        return $this->db->getSingleRecord($stmt);
    }
}
?>
