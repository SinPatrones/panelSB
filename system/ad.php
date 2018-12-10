<?php
include_once '../assets/connection.php';
include_once '../assets/security.php';
class AdFunctions{
    private $security =null;
    private $con = null;
    private static $instance = null;
    private function __construct(){
        $this->security = Security::getInstance();
        $this->con = ConnectionDb::getInstance();
        $this->con->connect();
    }
    public static function getInstance(){
        if (self::$instance == null)
            self::$instance = new self();
        return self::$instance;
    }
    public function insert($content,$priority,$status){
        if($this->con->connect()){
            session_start();
            $id = $_SESSION["user"]["id"];
            $this->security->applySecurityToObj($content);
            $this->security->applySecurityToObj($priority);
            $this->security->applySecurityToObj($status);
            $content = $this->con->realescape($content);
            $priority = $this->con->realescape($priority);
            if($status==1){
                $query = "INSERT INTO ad (content,id_user,priority) VALUES ('$content','$id','$priority')";
                if($this->con->query($query)) {
                    $query = "INSERT INTO adactive (content,id_user,priority) VALUES ('$content','$id','$priority')";
                    if($this->con->query($query)) return 'oi';
                    else return 'ei';
                }
                else return 'ei';
            }
            else {
                $query = "INSERT INTO ad (content,id_user,priority) VALUES ('$content','$id','$priority')";
                if($this->con->query($query)) return 'oi';
                else return 'ei';
            }

        }
        else return 'ec';
    }
    public function listactive(){
        if($this->con->connect()){
            $sql = "SELECT * FROM adactive order by id_adactive desc";
            $results = $this->con->query($sql);
            $i = 0;
            if($this->con->getnumrows($results)> 0){
                while($row=$this->con->getarray($results)){
                    $tam = strlen($row['content']);
                    $duration = ($tam*3)/26;
                    if($i==0) echo '<div class="row">';
                    echo '
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="courses-inner res-mg-b-30">
                            <div class="courses-title">
                                <h2>'.$row['content'].'</h2>
                            </div>
                            <div class="courses-alaltic">
                                <span class="cr-ic-r"><span class="course-icon"><i class="fa fa-heart"></i></span> '.$row['total'].' emisiones</span>
                                <span class="cr-ic-r"><span class="course-icon"><i class="fa fa-user"></i></span> '.$row['total'] * 30 .' alcance</span>
                            </div>
                            <div class="course-des">
                                <p><span><i class="fa fa-clock"></i></span> <b>Duración:</b> '.round($duration,2).' seg.</p>
                                <p><span><i class="fa fa-clock"></i></span> <b>Departamento:</b> Jaku Emprende Unsa</p>
                                <p><span><i class="fa fa-clock"></i></span> <b>Prioridad:</b> '.$row['priority'].'</p>
                            </div>
                            <div class="product-buttons">
                                <button type="button" class="button-default cart-btn">Editar</button>
                            </div>
                        </div>
                    </div>';
                        $i++;
                   if($i==3) {echo '
                </div>'; $i=0;}
                }
                if($i>0 && $i<3) echo '
                </div>';
                echo '<br>';
            }
            else echo '<li>No hay anuncios activos</li>';
        }
        else echo '<li>Error al ingresar a la base de datos</li>';
    }
}
?>