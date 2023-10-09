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
                        $nav = ['username'=>$username, 'role'=> $role, 'profpic'=> $imagePath];
                    }else{
                        $nav = ['username'=>null];
                    }
                    $dataset=['book'=>$bookData];
                    $bookListView =$this->view('book','BookView', array_merge($dataset, $nav));
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
                        $role = $user['role'];
                        $imagePath = $user['image_path'];
                        $nav = ['username'=>$username, 'role'=> $role, 'profpic'=> $imagePath];
                    }else{
                        $nav = ['username'=>null];
                    }

                    $bookListView =$this->view('book','BookDetailView', array_merge($book, $nav));
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

     // public function search(string $params) {

     // }

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
                
                    // header("Location: /public/song/detail/$bookId", true, 301);
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