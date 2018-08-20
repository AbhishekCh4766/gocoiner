@extends('layouts.master')

@section('title', 'Search Results')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">

                    <div class="table-responsive">
                        @if(count($results) == 0)
                            <div class="aligncenter">
                                <p>No News Found.</p>
                            </div>
                        @else
                            @include('frontend.news', ['news' => $news])
                            <nav>{!! $q->appends(\Request::except('page'))->render('vendor.pagination.simple-bootstrap-4') !!}</nav>

                            <?php
if(!empty($posts ))  
{ 
    $count = 1;
    $outputhead = '';
    $outputbody = '';  
    $outputtail ='';

    $outputhead .= '<div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Body</th>
                                <th>Created At</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                ';
                  
    foreach ($posts as $post)    
    {   
    $body = substr(strip_tags($post->body),0,50)."...";
    $show = url('blog/'.$post->slug);
    $outputbody .=  ' 
                
                            <tr> 
                                <td>'.$count++.'</td>
                                <td>'.$post->title.'</td>
                                <td>'.$body.'</td>
                                <td>'.$post->created_at.'</td>
                                <td><a href="'.$show.'" target="_blank" title="SHOW" ><span class="glyphicon glyphicon-list"></span></a></td>
                            </tr> 
                    ';
                
    }  

    $outputtail .= ' 
                        </tbody>
                    </table>
                </div>';
         
    echo $outputhead; 
    echo $outputbody; 
    echo $outputtail; 
 }  
 
 else  
 {  
    echo 'Data Not Found';  
 } 
 ?>  
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection