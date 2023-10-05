<?
class GenreModel {
    private $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function createGenre($name, $description)
    {
        $sql = "INSERT INTO genre (name, description) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $this->db->bindParams($stmt, "ss", $name, $description);
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
        $result = $this->db->execute($stmt);
        return $this->db->getAllRecords($stmt);
    }

    public function updateGenre($name, $description)
    {
        $sql = "UPDATE genre SET description = ? WHERE name = ?";
        $stmt = $this->db->prepare($sql);
        $this->db->bindParams($stmt, "ss", $description, $name);
        return $this->db->execute($stmt);
    }

    public function deleteGenreByName($name)
    {
        $sql = "DELETE FROM genre WHERE name = ?";
        $stmt = $this->db->prepare($sql);
        $this->db->bindParams($stmt, "s", $name);
        return $this->db->execute($stmt);
    }
}
?>
