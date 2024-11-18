  <?php 
      $project1[] = ["stage"=>"planning","task"=>10];
      $project1[] = ["stage"=>"doing","task"=>6];
      $project1[] = ["stage"=>"done","task"=>6];
      $project1[] = ["stage"=>"report","task"=>5];
    
      // Data for the second pie chart
      $project2[] = ["stage"=>"planning","task"=>4];
      $project2[] = ["stage"=>"doing","task"=>5];
      $project2[] = ["stage"=>"done","task"=>9];

      // Data for the second pie chart
      $project3[] = ["stage"=>"planning","task"=>4];
      $project3[] = ["stage"=>"doing","task"=>1];
      $project3[] = ["stage"=>"done","task"=>10];

      // Data for the second pie chart
      $project4[] = ["stage"=>"planning","task"=>1];
      $project4[] = ["stage"=>"doing","task"=>10];
      $project4[] = ["stage"=>"done","task"=>4];

      // Data for line chart
      $totalProject[] = ["project"=>"project1"];
      $totalProject[] = ["project"=>"project2"];
      $totalProject[] = ["project"=>"project3"];
      $totalProject[] = ["project"=>"project4"];

      //for done percentage of each project
      // $donePercentageforProject1 = calculateDonepercentage($project1);
      // $donePercentageforProject2 = calculateDonepercentage($project2);
      // $donePercentageforProject3 = calculateDonepercentage($project3);
      // $donePercentageforProject4 = calculateDonepercentage($project4);

      $donePercentage[]='';
      $j=0;

    for($i=1 ; $i<= count($totalProject) ; $i++){
      $projectVariable = "project" . ($i);
      // Calculate done percentage and push it to the $donePercentage array
      $donePercentage[$j] = calculateDonePercentage($$projectVariable);
      $j++;

      }
    

      $overall_done_rate = calculate_total_overall_project($donePercentage,$totalProject);
    
      function calculate_total_overall_project($donePercentage,$totalProject){
          $totalP = count($totalProject);
          $totalDonePrate = 0;

          foreach($donePercentage as $dp){
              $totalDonePrate += $dp;
          }

          return ($totalDonePrate/$totalP);

      }
      function calculateDonepercentage($project){

        $totaltask = 0;
        $donepercentage = 0;
        foreach($project as $p){
          $totaltask += $p['task']; 
      
        }
      
        foreach($project as $p){
            if($p['stage']==='done'){
            
              $donepercentage =  ( $p['task']/$totaltask) *100 ;
              $donepercentage =  number_format($donepercentage, 2);
            }
          }

        return $donepercentage;
      }
  ?>

  <?php 
      // bar chart for home page overview for all task (test_data)

      $total_stages[] = ["stage"=>"planning","task"=>0];
      $total_stages[] = ["stage"=>"doing","task"=>2];
      $total_stages[] = ["stage"=>"done","task"=>4];
      $total_stages[] = ["stage"=>"report","task"=>5];
  
      echo "<script>";
      echo "var barChartData = " . json_encode($total_stages) . ";" ; //barChartData was use by the home_admin/home_member page
      echo "</script>";
  ?>


  <?php 
      // line chart for home page_member task (test_data)

      $member1[] = ["stage"=>"planning","task"=>0];
      $member1[] = ["stage"=>"doing","task"=>2];
      $member1[] = ["stage"=>"done","task"=>4];
      $member1[] = ["stage"=>"report","task"=>5];
      

      $member2[] = ["stage"=>"planning","task"=>1];
      $member2[] = ["stage"=>"doing","task"=>2];
      $member2[] = ["stage"=>"done","task"=>3];
      $member2[] = ["stage"=>"report","task"=>0];
      
      $member3[] = ["stage"=>"planning","task"=>2];
      $member3[] = ["stage"=>"doing","task"=>1];
      $member3[] = ["stage"=>"done","task"=>5];
      $member3[] = ["stage"=>"report","task"=>8];
      

      $member4[] = ["stage"=>"planning","task"=>10];
      $member4[] = ["stage"=>"doing","task"=>2];
      $member4[] = ["stage"=>"done","task"=>34];
      $member4[] = ["stage"=>"report","task"=>55];
      

      $member5[] = ["stage"=>"planning","task"=>10];
      $member5[] = ["stage"=>"doing","task"=>22];
      $member5[] = ["stage"=>"done","task"=>54];
      $member5[] = ["stage"=>"report","task"=>15];
      

      $member6[] = ["stage"=>"planning","task"=>30];
      $member6[] = ["stage"=>"doing","task"=>2];
      $member6[] = ["stage"=>"done","task"=>44];
      $member6[] = ["stage"=>"report","task"=>15];
      

      $member7[] = ["stage"=>"planning","task"=>10];
      $member7[] = ["stage"=>"doing","task"=>2];
      $member7[] = ["stage"=>"done","task"=>34];
      $member7[] = ["stage"=>"report","task"=>55];


      $member8[] = ["stage"=>"planning","task"=>2];
      $member8[] = ["stage"=>"doing","task"=>1];
      $member8[] = ["stage"=>"done","task"=>5];
      $member8[] = ["stage"=>"report","task"=>8];
      

  ?>