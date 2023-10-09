<?
class BookModel { 
    private $db;

    public function __construct()
    {
        $this->db = Db::getInstance();
    }

    // CRUD Operations

    public function addBook(
        string $title, int $year, string $summary, int $price, 
        int $duration, string $lang, string $audio_path, string $img_path,
        array $authors, array $genres
    ): bool {
        $sql = "INSERT INTO book 
            (title, year, summary, price, duration, lang, audio_path, cover_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
     
        $stmt = $this->db->prepare($sql);
        $this->db->bindParams($stmt, "sisiisss", 
            $title, $year, $summary, $price, $duration, $lang, $audio_path, $img_path
        );

        $this->db->execute($stmt);
        $bookId = $this->db->insertId();

        echo $bookId;

        $stmt->close();

        if ($bookId) {
            foreach ($authors as $authorId) {
                $this->addAuthorToBook($bookId, $authorId);
            }

            foreach ($genres as $genreId) {
                $this->addGenreToBook($bookId, $genreId);
            }

            return true;
        }

        return $bookId;
    }

    public function updateBook(
        int $bookId, string $title, int $year, string $summary, int $price, 
        int $duration, string $lang, string $audio_path, string $img_path,
        array $authors, array $genres
    ): bool {
        $sql = "UPDATE book SET 
            title = ?, year = ?, summary = ?, price = ?, duration = ?, 
            lang = ?, audio_path = ?, cover_path = ? 
            WHERE book_id = ?";

        $stmt = $this->db->prepare($sql);
        $this->db->bindParams($stmt, "sisiisssi", 
            $title, $year, $summary, $price, $duration, $lang, $audio_path, $img_path, $bookId
        );

        $result = $this->db->execute($stmt);
        $bookId = $this->db->insertId();

        $stmt->close();

        if ($result) {
            $this->removeAuthorsFromBook($bookId);
            $this->removeGenresFromBook($bookId);

            foreach ($authors as $authorId) {
                $this->addAuthorToBook($bookId, $authorId);
            }

            foreach ($genres as $genreId) {
                $this->addGenreToBook($bookId, $genreId);
            }

            return true;
        }

        return false;
    }

    public function deleteBook(int $bookId): bool {
        $this->removeAuthorsFromBook($bookId);
        $this->removeGenresFromBook($bookId);

        $sql = "DELETE FROM book WHERE book_id = ?";
        
        $stmt = $this->db->prepare($sql);
        $this->db->bindParams($stmt, "i", $bookId);

        $result = $this->db->execute($stmt);

        $stmt->close();
        return $result;
    }

    public function getBookById(int $bookId) {
        $sql = "SELECT b.*, GROUP_CONCAT(DISTINCT a.full_name) AS authors, GROUP_CONCAT(DISTINCT g.name) AS genres
                FROM book b
                JOIN authored_by ab ON b.book_id = ab.book_id
                JOIN author a ON ab.author_id = a.author_id
                JOIN book_genre bg ON b.book_id = bg.book_id
                JOIN genre g ON bg.genre_id = bg.genre_id = g.genre_id
                WHERE b.book_id = ?
                GROUP BY b.book_id";
        
        $stmt = $this->db->prepare($sql);
        $this->db->bindParams($stmt, "i", $bookId);

        $this->db->execute($stmt);
        $book = $this->db->getSingleRecord($stmt);

        $stmt->close();
        return $book;
    }

    public function getBooks(int $page) {
        $perPage = BOOK_PER_PAGES;
        $offset = ($page - 1) * $perPage;

        $sql = "SELECT b.*, GROUP_CONCAT(DISTINCT a.full_name) AS authors, GROUP_CONCAT(DISTINCT g.name) AS genres
                FROM book b
                JOIN authored_by ab ON b.book_id = ab.book_id
                JOIN author a ON ab.author_id = a.author_id
                JOIN book_genre bg ON b.book_id = bg.book_id
                JOIN genre g ON bg.genre_id = g.genre_id
                GROUP BY b.book_id
                ORDER BY b.title
                LIMIT ? OFFSET ?";
        
        $stmt = $this->db->prepare($sql);
        $this->db->bindParams($stmt, "ii",  $perPage,$offset);

        $this->db->execute($stmt);
        $books = $this->db->getAllRecords($stmt);

        $stmt->close();
        return $books;
    }

    public function getTotalPages($perPage) {
        $sql = "SELECT COUNT(*) AS total FROM book";
        
        $stmt = $this->db->prepare($sql);
        $this->db->execute($stmt);
        $total = $this->db->getSingleRecord($stmt);

        $stmt->close();
        return ceil($total['total'] / $perPage);
    }

    private function addAuthorToBook(int $bookId, int $authorId): bool {
        $sql = "INSERT INTO authored_by (book_id, author_id) VALUES (?, ?)";
        
        $stmt = $this->db->prepare($sql);
        $this->db->bindParams($stmt, "ii", $bookId, $authorId);

        $result = $this->db->execute($stmt);

        $stmt->close();
        return $result;
    }

    private function addGenreToBook(int $bookId, int $genreId): bool {
        $sql = "INSERT INTO book_genre (book_id, genre_id) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        
        $this->db->bindParams($stmt, "ii", $bookId, $genreId);

        $result = $this->db->execute($stmt);

        $stmt->close();
        return $result;
    }

    private function removeAuthorsFromBook(int $bookId): bool {
        $sql = "DELETE FROM authored_by WHERE book_id = ?";
        $stmt = $this->db->prepare($sql);
        $this->db->bindParams($stmt, "i", $bookId);

        $result = $this->db->execute($stmt);

        $stmt->close();
        return $result;
    }

    private function removeGenresFromBook(int $bookId): bool {
        $sql = "DELETE FROM book_genre WHERE book_id = ?";
        $stmt = $this->db->prepare($sql);
        $this->db->bindParams($stmt, "i", $bookId);

        $result = $this->db->execute($stmt);

        $stmt->close();
        return $result;
    }
}
?>