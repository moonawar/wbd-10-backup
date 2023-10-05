<?
class AuthorModel {
     
    private $db;

    public function __construct(Db $db)
    {
        $this->db = $db; 
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
        return $this->db->getAllRecords($stmt);
    }
}
?>