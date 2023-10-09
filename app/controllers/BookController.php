<?
class BookController extends Controller implements ControllerInterface{
    private BookModel $model;

    public function __construct() {
        $this->model  = $this->model('BookModel');
    }

     public function index() 
     {
        try{
            switch($_SERVER['REQUEST_METHOD']){
                case 'GET':
                    $bookData = $this->model->getBooks(1);

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
                    } else {
                        $nav = ['username'=>null];
                        $have = ['own'=>null];
                    }

                    if(!isset($_GET['page'])) {
                        $page = 1;
                    } else {
                        $page = $_GET['page'];
                    }

                    $_SESSION['page'] = $page;

                    $genre = ['genres'=>$this->model('GenreModel')->getAllGenres()];
                    $author = ['authors'=>$this->model('AuthorModel')->getAllAuthors()];
                    $dataset=['book'=>$bookData];
                    $paginationData = ['totalPages' => $this->model->getTotalPages(8), 'page' => 1];
                    $bookListView =$this->view('book','BookView', array_merge($dataset, $nav, $genre, $author, $have, $paginationData));
                    $bookListView->render();
                    break;
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
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // show the add book page
                    $addBookView = $this->view('admin', 'AddBookView');
                    $addBookView->render(); 
                    break;
                case 'POST':
                    $fileHandler = new FileHandler();
                    
                    $imageFile = $_FILES['cover']['tmp_name'];
                    
                    $audioFile = $_FILES['audio']['tmp_name'];
                    $duration = (int) $fileHandler->getAudioDuration($audioFile);

                    $uploadedAudio = $fileHandler->saveAudioTo($audioFile, $_POST['title'], AUDIOBOOK_PATH);
                    $uploadedImage = $fileHandler->saveImageTo($imageFile, $_POST['title'], BOOK_COVER_PATH);

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
                            exit;
                        }

                        // $editBookView = $this->view('admin', 'UpdateBookView', 
                        // ['username' => $username,'role' => $this->model->getUserRole($username)]);
                        // $editBookView->render();

                        exit;
                    }

                    break;
                case 'POST':
                    $uploadedImage = PROFILE_PIC_BASE;
                    
                    if (isset($_FILES['profile-pic'])) {
                        $fileHandler = new FileHandler();
                        
                        $imageFile = $_FILES['profile-pic']['tmp_name'];
                        
                        $uploadedImage = $fileHandler->saveImageTo($imageFile, $_POST['username'], PROFILE_PIC_PATH);
                    }

                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $pass = $_POST['password'];
                    
                    $this->model->addUser(
                        $username, $email, UserRole::Customer, $pass, $uploadedImage
                    );
                
                    http_response_code(301);
                    header("Location: /book/", true, 301);

                    exit;
                case 'PATCH':
                    if ($_SESSION['role'] != UserRole::Admin) {
                        $unauthorizedView = $this->view('.', 'UnauthorizedView');
                        $unauthorizedView->render();
                        exit;   
                    }

                    $username = $params;
                    $role = $_POST['role'];

                    $this->model->updateRole($username, $role);

                    http_response_code(301);
                    header("Location: /user/update", true, 301);

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
                    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'title';
                    $filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
                    $bookData = $this->model->getByQuery($q, $_GET['sort'], $_GET['filter'], $page);

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
                    $genre = ['genres'=>$this->model('GenreModel')->getAllGenres()];
                    $author = ['authors'=>$this->model('AuthorModel')->getAllAuthors()];
                    $dataset=['book'=>$bookData];
                    $bookListView =$this->view('book','BookView', array_merge($dataset, $nav, $genre, $author, $have));
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
}
?>