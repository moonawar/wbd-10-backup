<?
class AuthorModel {
     
    private $db;

    public function __construct()
    {
        $this->db = Db::getInstance(); 
    }

    // CRUD Operations
    public function addAuthor(string $fullName, int $age = null): bool {
        $sql = "INSERT INTO author (full_name, age) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $this->db->bindParams($stmt, "si", $fullName, $age);
        return $this->db->execute($stmt);
    }

    public function getAuthorById(int $authorId) {
        $sql = "SELECT * FROM author WHERE author_id = ?";
        $stmt = $this->db->prepare($sql);
        $this->db->bindParams($stmt, "i", $authorId);
        $this->db->execute($stmt);
        return $this->db->getSingleRecord($stmt);
    }

    public function updateAuthor(int $authorId, string $fullName, int $age = null): bool {
        $sql = "UPDATE author SET full_name = ?, age = ? WHERE author_id = ?";
        $stmt = $this->db->prepare($sql);
        $this->db->bindParams($stmt, "sii", $fullName, $age, $authorId);
        return $this->db->execute($stmt);
    }

    public function deleteAuthor(int $authorId): bool {
        $sql = "DELETE FROM author WHERE author_id = ?";
        $stmt = $this->db->prepare($sql);
        $this->db->bindParams($stmt, "i", $authorId);
        return $this->db->execute($stmt);
    }

    public function getAllAuthors() {
        $sql = "SELECT * FROM author";
        $stmt = $this->db->prepare($sql);
        $this->db->execute($stmt);
        $res = $this->db->getAllRecords($stmt);
        $stmt->close();
        return $res;
    }

    public function authorExist(int $id) {
        $sql = "SELECT * FROM author WHERE author_id = ?";

        $stmt = $this->db->prepare($sql);
        $this->db->bindParams($stmt, "i", $id);

        $this->db->execute($stmt);

        $author = $this->db->getSingleRecord($stmt);

        $stmt->close();

        return $author;
    }

    public function getAuthors($page, $perPage) {
        $sql = "SELECT * FROM author LIMIT ? OFFSET ?";

        $stmt = $this->db->prepare($sql);
        $offset = ($page - 1) * $perPage;
        
        $this->db->bindParams($stmt, "ii", $perPage, $offset);

        $this->db->execute($stmt);

        $authors = $this->db->getAllRecords($stmt);

        $stmt->close();

        return $authors;
    }

    public function getTotalPages($perPage) {
        $sql = "SELECT COUNT(*) FROM author";

        $stmt = $this->db->prepare($sql);
        $this->db->execute($stmt);

        $result = $this->db->getSingleRecord($stmt);

        $stmt->close();

        return ceil($result['COUNT(*)'] / $perPage);
    }

}
?>