<?php include './header.php'; ?>
<?php include './side.php'; ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-envelope-o"></i> Mailbox</h1>
      
        </div>
     
      </div>
      <div class="row">
   
        <div class="col-md-12">
          <div class="tile">
   
            <div class="table-responsive mailbox-messages">
                <table class="table table-hover" id="sampleTable">
                <tbody>
                  <tr>
                    <td>
                  
                    </td>
                    <td></td>
                    <td><a href="read-mail.html">John Doe</a></td>
                    <td class="mail-subject"><b>A report on project almanac</b> - Lorem ipsum dolor sit amet adipisicing elit...</td>
                    <td></td>
                    <td><a href="" class="btn btn-sm btn-info">Reply</a></td>
                  </tr>
                <tr>
                    <td>
                  
                    </td>
                    <td></td>
                    <td><a href="read-mail.html">John Doe</a></td>
                    <td class="mail-subject"><b>A report on project almanac</b> - Lorem ipsum dolor sit amet adipisicing elit...</td>
                    <td></td>
                    <td><a href="" class="btn btn-sm btn-info">Reply</a></td>
                  </tr>
                        <tr>
                    <td>
                  
                    </td>
                    <td></td>
                    <td><a href="read-mail.html">John Doe</a></td>
                    <td class="mail-subject"><b>A report on project almanac</b> - Lorem ipsum dolor sit amet adipisicing elit...</td>
                    <td></td>
                    <td><a href="" class="btn btn-sm btn-info">Reply</a></td>
                  </tr>
                </tbody>
              </table>
            </div>
    
          </div>
        </div>
      </div>
    </main>
<?php include './footer.php';?>
<script type="text/javascript">$('#sampleTable').DataTable();</script>