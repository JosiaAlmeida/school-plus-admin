<?php $caminho="./" ?>
<!DOCTYPE html>
<html lang="en">
<?php include $caminho.'header.php' ?>
<body class="g-sidenav-show  bg-gray-200">
  <?php include_once $caminho.'Sidebar.php' ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <?php 
      include $caminho.'Navbar.php';
      include_once '../service/delete.php';
    ?>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Tabela De Alunos</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <form action="./tables.php" method="POST">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Curso</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Telefone</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Idade</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">BI</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                          Media</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ativar</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($alunosNaoSelecionado as $key => $value):
                      ?>
                      <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm"> <?=$value['nome']?> </h6>
                                <p class="text-xs text-secondary mb-0"><?=$value['escola_antiga']?></p>
                              </div>
                            </div>
                          </td>
                          <td>
                            <p class="text-xs font-weight-bold mb-0"><?=$value['Curso']?></p>
                          </td>
                          </td>
                          <td>
                            <p class="text-xs font-weight-bold mb-0"><?=$value['telefone']?></p>
                          </td>
                          </td>
                          <td>
                            <p class="text-xs font-weight-bold mb-0"><?=$value['idade']?></p>
                          </td>
                          </td>
                          <td>
                            <p class="text-xs font-weight-bold mb-0"><?=$value['bi']?></p>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold"><?=$value['media']?></span>
                          </td>
                        <td class="align-middle">
                          <div class="form-check form-switch ps-0">
                            <?php
                              if($value['selecionado']):
                            ?>
                              <input class="form-check-input ms-auto" onchange="(v)=>handleChange(v.target.value)" type="checkbox" value="<?= $value['id']?>" name="<?= $value['id']?>" id="<?= $value['id']?>" checked>
                            <?php 
                              else:
                            ?>
                              <input class="form-check-input ms-auto" onchange="(v)=>handleChange(v.target.value)" type="checkbox" value="<?= $value['id']?>" name="<?= $value['id']?>" id="<?= $value['id']?>">
                            <?php endif;?>
                          </div>
                        </td>
                          <td>
                            <button class="btn" type="submit" value="<?=$value['id']?>" name="deletar">
                              <i onclick="<?php $deleteId = $value['id'];?>" class="material-icons opacity-10">delete</i>
                            </button>
                          </td>
                      </tr>
                      <?php endforeach;
                      ?>
                    </tbody>
                  </table>
                  <div class="p-3">
                    <button class="btn btn-success" type="submit">Salvar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
    var valueChange= []
    const handleChange = (item)=>{
      valueChange.push(item)
      console.log("item")
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.0.0"></script>
</body>

<?php
  $idArray = array();
  foreach ($alunosNaoSelecionado as $key => $value){
    array_push($idArray, $_POST[$value["id"]]);
  }
  foreach($idArray as $key){
    $alunosNaoSelecionado= array();
    try {
      if($key){
        $querychangeCandidatura = "UPDATE candidatura SET selecionado=1 WHERE id='$key'";
        $changeCandidatura = $myslq_i->query($querychangeCandidatura);
        $queryAlunoNaoAceito = "SELECT cd.id ,cd.nome, cd.idade, cd.escola_antiga, cd.telefone, cd.bi, cd.sexo, cd.media, cd.selecionado, cs.nome 'Curso' FROM candidatura as cd join curso as cs where cd.selecionado=0 and cd.Curso_id=cs.id";
          $alunosCandidaturaNaoAptos = $myslq_i->query($queryAlunoNaoAceito);
          $result = array();
          while($row = $alunosCandidaturaNaoAptos->fetch_assoc()){
              extract($row);
              $item = array(
                  'id'=>$id,
                  'nome'=>$nome,
                  'idade'=>$idade,
                  'telefone'=>$telefone,
                  'bi'=>$bi,
                  'sexo'=>$sexo,
                  'escola_antiga'=>$escola_antiga,
                  'media'=>$media,
                  'selecionado'=>$selecionado,
                  'Curso'=>$Curso,
              );
              array_push($result, $item);
          }
          $alunosNaoSelecionado = $result;
      }
    } catch (\Throwable $th) {
    }
  }
  $myslq_i->close();
  header('location: ./dashboard.php');
?>
<script>
  window.addEventListener('submit', ()=> {location.href ="http://localhost:8000/pages/dashboard.php"})
</script>
</html>
