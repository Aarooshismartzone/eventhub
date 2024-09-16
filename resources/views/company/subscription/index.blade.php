<div class="row">
    <div class="col-sm-8">
        <div class="row mt-3">
            <div class="col-sm-3"><div class="lbl">Current Plan</div></div>
            <div class="col-sm-3"><div class="lbl" style="font-weight: 800; color: black">Standard Plan</div></div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-3"><div class="lbl">No. of Agents</div></div>
            <div class="col-sm-3"><div class="lbl" style="font-weight: 800; color: black">{{$subs->agent_limit}}</div></div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card bill-card">
            <div class="lbl mb-3" style="font-weight: 800; color: black">Next bill</div> {{-- added mb-3 --}}
            <h3 style="color: orangered; font-weight: 800; font-family: 'montserrat', sans-serif;">{{round($subs->amount,2)}}$</h3>
            <p class="lbl" style="font-weight: 800; color: black">{{$subs->exp_date}}</p>
        </div>
    </div>
</div>
<nav style="display: flex; justify-content: space-between">
    <div><h4 class="mt-5" style="font-weight: 800">Agents</h4></div>
    <div class="mt-5">
        <nav style="display: flex; justify-content: left">
            <div><img src="{{asset('images/icons/add-agent.png')}}" alt="" style="width: 50px; height: 60px" onclick="addform()"></div>
        <div class="mt-3 ms-2">Add Agent</div>
        </nav>
    </div>
</nav>
<table class="table mt-3">
  <thead>
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
       
        <th scope="col"></th>
      </tr>
  </thead>
  <tbody>
      @foreach($agents as $agent)
      <tr>
        <td>{{$agent->first_name}}</td>
        <td >{{$agent->email}}</td>        
        <td>
          <nav style="display: flex; justify-content: left">
          <div><button type="button" class="btn editbtn" data-bs-toggle="modal" data-bs-target="#editModal" onClick="editAgent({{$agent->id}})">Edit</button></div>
          <div><button type="button" class="btn deletebtn ms-2" data-bs-toggle="modal" data-bs-target="#deleteModal" onClick="editAgent({{$agent->id}})">Delete</button></div>
          </nav>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
	        <!--EDIT Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-5">
      <nav style="display: flex; justify-content: end">
        <div>
        <button type="button" class="btn-close" style="background-color: rgb(236, 236, 236); padding: 20px; border-radius: 30px" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      </nav>
      <h4 style="font-weight: bold; color: #07269B">Edit Agent</h4>
      <p class="updateAgentStatusMsg"></p>
      <form method="post" enctype="multipart/form-data" id="editAgent">
        @csrf
        <input type="hidden" name="agent_id" id="agent_id" value="">
        <div class="row mt-3">
          <div class="col-3 mt-2 lbl" style="font-weight:bold">Name</div>
          <div class="col-9 mt-2 lbl"><input type="text" name="agent_name" id="agent_name" class="form-control" value="" required></div>
        </div>
        <div class="row mt-3">
          <div class="col-3 mt-2 lbl" style="font-weight:bold">Email</div>
          <div class="col-9 mt-2 lbl"><input type="email" name="agent_email" id="agent_email" class="form-control" value="" required></div>
        </div>
        <div class="row mt-3">
          <div class="col-3 mt-2 lbl" style="font-weight:bold">Password</div>
          <div class="col-9 mt-2 lbl"><input type="text" name="agent_password" id="agent_password" class="form-control" value="" required></div>
        </div>
        <div class="mt-4 mb-3">
          <button type="button" class="btn bluebutton" onClick=updateAgent()>Save</button>
        </div>
      </form>
      
    </div>
  </div>
</div>

<!--DELETE Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content p-1">
      <nav style="display: flex; justify-content: end">
        <div>
          <button type="button" class="btn-close" style="background-color: rgb(236, 236, 236); padding: 20px; border-radius: 30px" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      </nav>
      <p class="updateAgentStatusMsg"></p>
      <form method="post" id="deleteAgent">
        @csrf
        <input type="hidden" name="agent_id" id="agentId" value="">
        <div class="p-4">
          <h4 style="font-weight: bold; color: #07269B">Delete Agent</h4>
          <p class="updateAgentStatusMsg"></p>
          <div class="mt-4 lbl">Are you sure, you want to delete <span class="agentName" style="font-weight:bold; color:#07269B"></span>, as an agent?</div>
          <div class="row mt-4 mb-3">
            <div class="col-3"><button type="button" class="btn bluebutton" onClick=deleteAgent()>Yes</button></div>
            <div class="col-3"><button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn bluebutton">No</button></div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>	  
<script>
  function deleteAgent(){
        
        var form = $('#deleteAgent')[0];		 
        var data = new FormData(form);

        $.ajax({
            type:'POST',
            enctype: 'multipart/form-data',
            processData: false,
            url:"{{ url('/deleteAgent') }}",
            data:data,
            contentType: false,
            cache: false,
            timeout: 600000,        
            success:function(response){
                if( response.status == true ) {
                   
                    $('.updateAgentStatusMsg').html('<div class="card successcard">'+response.msg+'</div>');
                    setTimeout(function() 
                    {
                        location.reload();  //Refresh page
                    }, 1000);
                }
            }
        });

      }

      function editAgent(aid){
        $('.agentName').html('');
        $('#agentId').val('');
        $('#agent_id').val('');
        $('#agent_name').val('');
        $('#agent_email').val('');
          var aid=aid;
          $.ajax({
            type:'get',            
            url:"{{ url('/agentDetails') }}/"+aid,
             
            success:function(response){
                  if( response.status == true ) {
                   
                    $('#agent_id').val(response.agent.id);
                    $('#agentId').val(response.agent.id);
                    $('.agentName').html(response.agent.first_name);
                    $('#agent_name').val(response.agent.first_name);
                    $('#agent_email').val(response.agent.email);
                  }
            }
        });

      }
      
      function updateAgent(){
       

        var form = $('#editAgent')[0];		 
        var data = new FormData(form);

        $.ajax({
            type:'POST',
            enctype: 'multipart/form-data',
            processData: false,
            url:"{{ url('/updateAgent') }}",
            data:data,
            contentType: false,
            cache: false,
            timeout: 600000,        
            success:function(response){
                if( response.status == true ) {
                   
                    $('.updateAgentStatusMsg').html('<div class="card successcard">'+response.msg+'</div>');
                    setTimeout(function() 
                    {
                        location.reload();  //Refresh page
                    }, 1000);
                }
            }
        });
    
      }

  </script>
	  
     