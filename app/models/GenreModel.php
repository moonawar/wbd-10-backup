<?
class GenreModel {
    private $db;

    public function __construct()
    {
        $this->db = Db::getInstance();
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
        $this->db->execute($stmt);
        $res = $this->db->getAllRecords($stmt);
        $stmt->close();
        return $res;
    }

    public function getGenres($page, $perPage) {
        $sql = "SELECT * FROM genre LIMIT ? OFFSET ?";

        $stmt = $this->db->prepare($sql);
        $offset = ($page - 1) * $perPage;
        
        $this->db->bindParams($stmt, "ii", $perPage, $offset);

        $this->db->execute($stmt);

        $genres = $this->db->getAllRecords($stmt);

        $stmt->close();

        return $genres;
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
        $this->db->execute($stmt);
        return $this->db->getSingleRecord($stmt);
    }
    public function getTotalPages($perPage) {
        $sql = "SELECT COUNT(*) FROM genre";

        $stmt = $this->db->prepare($sql);
        $this->db->execute($stmt);

        $result = $this->db->getSingleRecord($stmt);

        $stmt->close();

        return ceil($result['COUNT(*)'] / $perPage);
    }
}
?>
