<?php
class ArticleManager
{
    private $db;

    // Methode 
    public function __construct()
    {
        $dbName = 'blog';
        $port = 3307;
        $username = 'root';
        $password = 'root';
        try {
            $this->setDb(new PDO("mysql:host=localhost;dbname=$dbName;port=$port", $username, $password));
        } catch (PDOException $error) {
            echo $error->getMessage();
        }
    }
    public function setDb($db)
    {
        $this->db = $db;
        return $this;
    }


    public function add(Article $article)
    {
        $req = $this->db->prepare("INSERT INTO `article` (title, content, created_at, author, lien_image) VALUES(:title, :content, :created_at, :author, :lien_image)");

        $req->bindValue(":title", $article->getTitle(), PDO::PARAM_STR);
        $req->bindValue(":content", $article->getContent(), PDO::PARAM_STR);
        $req->bindValue(":created_at", date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $req->bindValue(":author", $article->getAuthor(), PDO::PARAM_STR);
        $req->bindValue(":lien_image", $article->getLien_image(), PDO::PARAM_STR);

        $req->execute();
    }

    public function update(Article $article)
    {
        $req = $this->db->prepare("UPDATE `article` SET title = :title, content = :content, created_at = :created_at, author = :author, lien_image = :lien_image WHERE id = :id");

        $req->bindValue(":id", $article->getId(), PDO::PARAM_INT);
        $req->bindValue(":title", $article->getTitle(), PDO::PARAM_STR);
        $req->bindValue(":content", $article->getContent(), PDO::PARAM_STR);
        $req->bindValue(":created_at", date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $req->bindValue(":author", $article->getAuthor(), PDO::PARAM_STR);
        $req->bindValue(":lien_image", $article->getLien_image(), PDO::PARAM_STR);

        $req->execute();
    }
    public function delete(int $id): void
    {
        $req = $this->db->prepare("DELETE FROM `article` WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();
    }


    public function get(int $id): Article
    {
        $req = $this->db->prepare("SELECT * FROM `article` WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();

        $donnees = $req->fetch();
        $article = new Article($donnees);
        return $article;
    }

    public function getLast(): Article
    {
        $req = $this->db->query("SELECT * FROM `article` ORDER BY id DESC LIMIT 1");
        $req->execute();

        $donnees = $req->fetch();
        $article = new Article($donnees);
        return $article;
    }

    public function getAll(): array
    {
        $articles = [];
        $req = $this->db->query("SELECT * FROM `article` ORDER BY create_at desc");
        $req->execute();

        $donnees = $req->fetchAll();
        foreach ($donnees as $donnee) {
            $articles[] = new Article($donnee);
        }

        return $articles;
    }

    public function getAllTitle(): array
    {
        $articles = [];
        $req = $this->db->query("SELECT * FROM `article` ORDER BY title ");
        $req->execute();

        $donnees = $req->fetchAll();
        foreach ($donnees as $donnee) {
            $articles[] = new Article($donnee);
        }

        return $articles;
    }

    public function getAllAuthor(): array
    {
        $articles = [];
        $req = $this->db->query("SELECT * FROM `article` ORDER BY author ");
        $req->execute();

        $donnees = $req->fetchAll();
        foreach ($donnees as $donnee) {
            $articles[] = new Article($donnee);
        }

        return $articles;
    }
}
