 <div class="bg-white">
                  <?php foreach($imagens_post as $img) {
                    array_map(function($value)
                    {
                            var_dump($value['url']);
                    }, $img); 

                    die();
                     array_walk($img, function ($img, $indice){
                       var_dump( $indice);  
                     array_walk($img, function ($value, $key){  
                       var_dump( $value);   
                      });          
                   });          
                    ///var_dump($img);
                    die();       
                           }
                             ?>   

                  </div> 


<!--  <div style="display: none; width: 64px; margin: -50px auto 0;"  class="d-block mx-auto align-middle">  

                            <i style="z-index: 2; box-shadow: 3px" class="p-2 d-none bg-white text-success rounded-circle <?// ($listar['category_name'] == 'hotel and line resorts' ? "fa fa-hotel fa-3x" : "fa fa-home fa-3x");  ?>"></i>   
                            </div>
                            <h5 class="text-uppercase"><? //$listar['category_name']; ?></h5> 
                          -->  
<?php 
private $Result;
    public function getResult() {
        return $this->Result;
    }
    public function searchUser($dados_form) {
        $array = array();
        $where = $this->buildWhere($dados_form);
        $sql = $this->db->prepare("SELECT * FROM usuarios WHERE " . implode(' AND ', $where));

        $this->bindWhere($dados_form, $sql);

        try {
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $this->Result = $sql->fetchAll();
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    private function buildWhere($dados_form) {
        $where = array(
            '1=1'
        );

        if (!empty($dados_form['nome'])) {
            $where[] = "nome LIKE '%':nome'%'";
        }

        if (!empty($dados_form['id'])) {
            $where[] = "id = :id";
        }

        if (!empty($dados_form['sexo'])) {
            $where[] = "sexo = :sexo";
        }

        return $where;
    }

    private function bindWhere($dados_form, $sql) {
        if (!empty($dados_form['nome'])) {
            $sql->bindValue(":nome", $dados_form['nome']);
        }

        if (!empty($dados_form['id'])) {
            $sql->bindValue(":id", $dados_form['id']);
        }

        if (!empty($dados_form['sexo'])) {
            $sql->bindValue(":sexo", $dados_form['sexo']);
        }
    }

