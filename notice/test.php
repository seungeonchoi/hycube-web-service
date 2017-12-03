

        <div class="wrapper">
            <header>
              <div>
                <button onclick="showfile('navigation-list');">
                <span class="menuBtn">첨부파일</span>
              </button>
            </div>
                <nav id="navigation-list" style="display: none;">
                  <ul>
                        <li><a href="#item1">test1</a></li>
                        <li><a href="#item2">test2</a></li>
                        <li><a href="#item3">test3</a></li>
                        <li><a href="#item4">test4</a></li>
                    </ul>
                </nav>
            </header>
        </div>

            <script type="text/javascript">
            function showfile(id){
              obj=document.getElementById(id)

              if(obj.style.display == "none"){
                obj.style.display="inline";
              }
              else{
                obj.style.display="none";
              }
            }
            </script>




  <!--
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link href="../css/custom.css?val=ec1391232" rel="stylesheet">
  <script src="../plugin/jquery/dist/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>


  <div class = "col-xs-1" style="float:right">
  <button id=<"button-test" class="list-group-item" data-toggle="collapse" data-target="#test" data-parent="#accordion">
    <h4 class="list-group-item-heading kor dropdown-toggle" >
      <span id="title-list" style="font-size:0.85em">첨부파일</span>
      <span class="caret" style="float:right;margin-top:15px;" ></span></h4>

  </button>
  <div id="test" class="collapse panel panel-default padding-sm" data-parent="#accordion">
    <h3 class style="font-size:1.5em" id="number" = "kor">writer</h3>

    </div>
  </div>
