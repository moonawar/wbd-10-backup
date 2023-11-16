<?
class BookController extends Controller implements ControllerInterface{
    private BookModel $model;

    public function __construct() {
        require_once __DIR__ . '/../models/UserRole.php';
        $this->model  = $this->model('BookModel');
    }

     public function index() 
     {
        try{
            switch($_SERVER['REQUEST_METHOD']){
                case 'GET':
                    header("Location: /book/search/1", true, 301);
                    exit;
            }
        }catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
       }   
     }

    public function details($id) {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $bookId = (int)$id;
                    $book=$this->model->getBookById($id);
                    if(!$book){
                        $book=['book_id'=> null];
                    }
                    // User
                    if(isset($_SESSION['username'])){
                        $userData = $this->model('UserModel');
                        $user = $userData->getUserByUsername($_SESSION['username']);
                        $username = $user['username'];
                        $own = $userData->getMyBook($_SESSION['username']);

                        $have = ['own'=>$own];
                        $nav = ['username'=>$username];
                    }else{
                        $nav = ['username'=>null];
                        $have=['own'=>NULL];
                    }
                    $bookListView =$this->view('book','BookDetailView', array_merge($book, $nav, $have));
                    $bookListView->render();
                    break;
                default:
                    throw new RequestException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
             http_response_code($e->getCode());
             exit;
        }          
    }

    public function add() 
    {
        if (!isset($_SESSION['username'])) {
            http_response_code(301);
            header("Location: /user/login", true, 301);
            exit;
        }
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if ($_SESSION['role'] != UserRole::Admin) {
                        $unauthorizedView = $this->view('.', 'UnauthorizedView');
                        $unauthorizedView->render();
                        exit;   
                    }
                    // show the add book page
                    $addBookView = $this->view('admin', 'AddBookView');
                    $addBookView->render(); 
                    break;
                case 'POST':
                    $uploadedImage = null;
                    if (isset($_POST['imagePath'])) {
                        $uploadedImage = $_POST['imagePath'];
                    }

                    $uploadedAudio = null;
                    if (isset($_POST['audioPath'])) {
                        $uploadedAudio = $_POST['audioPath'];
                    }

                    $fileHandler = new FileHandler();
                    
                    if(!$uploadedImage) {
                        $imageFile = $_FILES['cover']['tmp_name'];
                        $uploadedImage = $fileHandler->saveImageTo($imageFile, $_POST['title'], BOOK_COVER_PATH);
                        $uploadedImage = BASE_URL . '/' . $uploadedImage;
                    }
                    
                    if (!$uploadedAudio) {
                        $audioFile = $_FILES['audio']['tmp_name'];
                        $uploadedAudio = $fileHandler->saveAudioTo($audioFile, $_POST['title'], AUDIOBOOK_PATH);
                    }
                    
                    $duration = (int) $fileHandler->getAudioDuration($audioFile);
                    
                    $title = $_POST['title'];
                    $year = (int)$_POST['year'];
                    $summary = $_POST['summary'];
                    $price = (int)$_POST['price'];

                    $lang = 'English';
                    if (isset($_POST['lang'])) {
                        $lang = $_POST['lang'];
                    }
                    
                    $authors = $_POST['authors'];
                    $genres = $_POST['genres'];

                    
                    $bookId = $this->model->addBook(
                        $title, $year, $summary, $price, $duration, $lang,
                        $uploadedAudio, $uploadedImage, $authors, $genres
                    );
                    
                    header("Location: /book/", true, 301);
                    exit;

                    default:
                        throw new RequestException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            http_response_code($e->getCode());
            exit;
        }          
    }

    public function update($params = null) {
        if (!isset($_SESSION['username'])) {
            http_response_code(301);
            header("Location: /user/login", true, 301);
            exit;
        }
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if ($_SESSION['role'] != UserRole::Admin) {
                        $unauthorizedView = $this->view('.', 'UnauthorizedView');
                        $unauthorizedView->render();
                        exit;   
                    }

                    if(!isset($_GET['page'])) {
                        $page = 1;
                    } else {
                        $page = $_GET['page'];
                    }

                    $_SESSION['page'] = $page;
                    
                    if (isset($params)) {
                        $id = (int)$params;
                        $book = $this->model->getBookById($id);
                        if (!isset($book)) {
                            header("Location: /book/", true, 301);
                            exit;
                        }

                        
                        $editBookView = $this->view('admin', 'UpdateBookView', $book);
                        $editBookView->render();

                        exit;
                    }

                    break;
                case 'POST':
                    // $fileHandler = new FileHandler();
                    
                    // if (isset($_FILES['cover'])) {
                    //     $imageFile = $_FILES['cover']['tmp_name'];
                    //     $uploadedImage = $fileHandler->saveImageTo($imageFile, $_POST['title'], BOOK_COVER_PATH);
                    // } else {
                    //     $uploadedImage = $_POST['old']['image_path'];
                    // }

                    // if (isset($_FILES['audio'])) {
                    //     $audioFile = $_FILES['audio']['tmp_name'];
                    //     $duration = (int) $fileHandler->getAudioDuration($audioFile);
                    //     $uploadedAudio = $fileHandler->saveAudioTo($audioFile, $_POST['title'], AUDIOBOOK_PATH);
                    // } else {
                    //     $uploadedAudio = $_POST['old']['audio_path'];
                    //     $duration = $_POST['old']['duration'];
                    // }
                    
                    $id = $params;
                    $old = $this->model->getBookById($id);

                    $uploadedImage = $old['cover_path'];
                    $uploadedAudio = $old['audio_path'];
                    $duration = $old['duration'];

                    $title = !empty($_POST['title']) ? $_POST['title'] : $old['title'];
                    $year = !empty($_POST['year']) ? (int)$_POST['year'] : $old['year'];
                    $summary = !empty($_POST['summary']) ? $_POST['summary'] : $old['summary'];
                    $price = !empty($_POST['price']) ? (int)$_POST['price'] : $old['price'];

                    $lang = 'English';
                    if (isset($_POST['lang'])) {
                        $lang = $_POST['lang'];
                    }
                    
                    $bookId = $this->model->updateBook(
                        $old['book_id'], $title, $year, $summary, $price, $duration, $lang,
                        $uploadedAudio, $uploadedImage,
                        //  $authors, $genres
                    );

                    header("Location: /book/details/$id", true, 301);

                    exit;

                default:
                    throw new RequestException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }          
    }

    public function buy($params){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    $username = $_SESSION['username'];
                    $bookId = (int) $params;
                    $book = $this->model->addBookOwner(
                        $username, $bookId
                    );
                
                    header("Location: /book", true, 301);
                    exit;

                    default:
                        throw new RequestException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            http_response_code($e->getCode());
            exit;
        }          
    }


    public function search($page){
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $q = '';
                    
                    if (isset($_GET['q'])) {
                        $q = $_GET['q'];
                    }

                    if(!isset($page)) {
                        $page = 1;
                    } 

                    $_SESSION['page'] = $page;

                    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'title';
                    $filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

                    $bookData = $this->model->getByQuery($q, $sort, $filter, $page);
                    $count = $this->model->bookCount($q, $sort, $filter);
                    $totalPages = ceil($count / BOOK_PER_PAGES);

                    // User
                    if(isset($_SESSION['username'])){
                        $userData = $this->model('UserModel');
                        $user = $userData->getUserByUsername($_SESSION['username']);
                        $username = $user['username'];
                        $role = $user['role'];
                        $imagePath = $user['image_path'];

                        $own = $userData->getMyBook($_SESSION['username']);

                        $have = ['own'=>$own];
                        $nav = ['username'=>$username, 'role'=> $role, 'profpic'=> $imagePath];
                    }else{
                        $nav = ['username'=>null];
                        $have = ['own'=>null];
                    }
                    
                    $q_params = "?filter=$filter&sort=$sort&q=$q";

                    $genre = ['genres'=>$this->model('GenreModel')->getAllGenres()];
                    $author = ['authors'=>$this->model('AuthorModel')->getAllAuthors()];
                    $dataset=['book'=>$bookData];
                    $paginationData = ['totalPages' => $totalPages, 'page' => $page, 'q_params' => $q_params];
                    $bookListView =$this->view('book','BookView', array_merge($dataset, $nav, $genre, $author, $have, $paginationData));
                    $bookListView->render();
                    exit;
                default:
                    throw new RequestException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            http_response_code($e->getCode());
            exit;
        }
    }

    public function delete($params = null) {
        if (!isset($_SESSION['username'])) {
            http_response_code(301);
            header("Location: /user/login", true, 301);
            exit;
        }
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if ($_SESSION['role'] != UserRole::Admin) {
                        $unauthorizedView = $this->view('.', 'UnauthorizedView');
                        $unauthorizedView->render();
                        exit;   
                    }
                    
                    if (isset($params)) {
                        $book_id = $params;

                        $book = $this->model->getBookById($book_id);
                        if (!$book) {
                            header("Location: /book/", true, 301);
                            exit;
                        }


                        $deleteBookView = $this->view('admin', 'DeleteBookView', $book);
                        $deleteBookView->render();

                        exit;
                    }

                    break;
                case 'POST':
                    if (isset($params)) { // editing specific book
                        $id = $params;
                        
                        $succ = $this->model->deleteBook($id);
                        
                        if ($succ) {
                            header("Location: /book/", true, 301);
                        }
                        
                        echo "Failed to delete book";
                        break;
                    }

                    $notFoundView = $this->view('not-found', 'NotFoundView');
                    $notFoundView->render();

                exit;

                default:
                    throw new RequestException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }          
    }
}
?>