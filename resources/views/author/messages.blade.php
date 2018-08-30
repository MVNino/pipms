@extends('author.layouts.app')

@section('pg-title')
<h1><i class="fa fa-envelope"></i> Mails</h1>
	<p>Communicate with the administrator</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item"><a href="/author/messages">Mails</a></li>
@endsection
@section('content')
<div class="row">
	<div class="col-md-3"><a class="mb-2 btn btn-primary btn-block" href="">Compose Mail</a>
	  <div class="tile p-0">
	    <h4 class="tile-title folder-head">Folders</h4>
	    <div class="tile-body">
	      <ul class="nav nav-pills flex-column mail-nav">
	        <li class="nav-item active"><a class="nav-link" href="#"><i class="fa fa-inbox fa-fw"></i> Inbox<span class="badge badge-pill badge-primary float-right">12</span></a></li>
	        <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-envelope-o fa-fw"></i> Sent</a></li>
	        <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-file-text-o fa-fw"></i> Drafts</a></li>
	        <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-filter fa-fw"></i> Junk <span class="badge badge-pill badge-primary float-right">8</span></a></li>
	        <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-trash-o fa-fw"></i> Trash</a></li>
	      </ul>
	    </div>
	  </div>
	</div>
	<div class="col-md-9">
	  <div class="tile">
	    <div class="mailbox-controls">
	      <div class="animated-checkbox">
	        <label>
	          <input type="checkbox"><span class="label-text"></span>
	        </label>
	      </div>
	      <div class="btn-group">
	        <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-trash-o"></i></button>
	        <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-reply"></i></button>
	        <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-share"></i></button>
	        <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-refresh"></i></button>
	      </div>
	    </div>
	    <div class="table-responsive mailbox-messages">
	      <table class="table table-hover">
	        <tbody>
	          <tr>
	            <td>
	              <div class="animated-checkbox">
	                <label>
	                  <input type="checkbox"><span class="label-text"> </span>
	                </label>
	              </div>
	            </td>
	            <td><a href="#"><i class="fa fa-star-o"></i></a></td>
	            <td><a href="read-mail.html">John Doe</a></td>
	            <td class="mail-subject"><b>A report on project almanac</b> - Lorem ipsum dolor sit amet adipisicing elit...</td>
	            <td><i class="fa fa-paperclip"></i></td>
	            <td>8 mins ago</td>
	          </tr>
	          <tr>
	            <td>
	              <div class="animated-checkbox">
	                <label>
	                  <input type="checkbox"><span class="label-text"> </span>
	                </label>
	              </div>
	            </td>
	            <td><a href="#"><i class="fa fa-star"></i></a></td>
	            <td><a href="read-mail.html">John Doe</a></td>
	            <td><b>A report on some good project</b> - Lorem ipsum dolor sit amet adipisicing elit...</td>
	            <td></td>
	            <td>15 mins ago</td>
	          </tr>
	          <tr>
	            <td>
	              <div class="animated-checkbox">
	                <label>
	                  <input type="checkbox"><span class="label-text"> </span>
	                </label>
	              </div>
	            </td>
	            <td><a href="#"><i class="fa fa-star-o"></i></a></td>
	            <td><a href="read-mail.html">John Doe</a></td>
	            <td class="mail-subject"><b>A report on project almanac</b> - Lorem ipsum dolor sit amet adipisicing elit...</td>
	            <td><i class="fa fa-paperclip"></i></td>
	            <td>30 mins ago</td>
	          </tr>
	          <tr>
	            <td>
	              <div class="animated-checkbox">
	                <label>
	                  <input type="checkbox"><span class="label-text"> </span>
	                </label>
	              </div>
	            </td>
	            <td><a href="#"><i class="fa fa-star"></i></a></td>
	            <td><a href="read-mail.html">John Doe</a></td>
	            <td class="mail-subject"><b>A report on project almanac</b> - Lorem ipsum dolor sit amet adipisicing elit...</td>
	            <td></td>
	            <td>25 December</td>
	          </tr>
	          <tr>
	            <td>
	              <div class="animated-checkbox">
	                <label>
	                  <input type="checkbox"><span class="label-text"> </span>
	                </label>
	              </div>
	            </td>
	            <td><a href="#"><i class="fa fa-star-o"></i></a></td>
	            <td><a href="read-mail.html">John Doe</a></td>
	            <td class="mail-subject"><b>A report on project almanac</b> - Lorem ipsum dolor sit amet adipisicing elit...</td>
	            <td><i class="fa fa-paperclip"></i></td>
	            <td>20 December</td>
	          </tr>
	          <tr>
	            <td>
	              <div class="animated-checkbox">
	                <label>
	                  <input type="checkbox"><span class="label-text"> </span>
	                </label>
	              </div>
	            </td>
	            <td><a href="#"><i class="fa fa-star"></i></a></td>
	            <td><a href="read-mail.html">John Doe</a></td>
	            <td class="mail-subject"><b>A report on project almanac</b> - Lorem ipsum dolor sit amet adipisicing elit...</td>
	            <td></td>
	            <td>20 December</td>
	          </tr>
	          <tr>
	            <td>
	              <div class="animated-checkbox">
	                <label>
	                  <input type="checkbox"><span class="label-text"> </span>
	                </label>
	              </div>
	            </td>
	            <td><a href="#"><i class="fa fa-star"></i></a></td>
	            <td><a href="read-mail.html">John Doe</a></td>
	            <td class="mail-subject"><b>A report on project almanac</b> - Lorem ipsum dolor sit amet adipisicing elit...</td>
	            <td><i class="fa fa-paperclip"></i></td>
	            <td>20 December</td>
	          </tr>
	          <tr>
	            <td>
	              <div class="animated-checkbox">
	                <label>
	                  <input type="checkbox"><span class="label-text"> </span>
	                </label>
	              </div>
	            </td>
	            <td><a href="#"><i class="fa fa-star-o"></i></a></td>
	            <td><a href="read-mail.html">John Doe</a></td>
	            <td class="mail-subject"><b>A report on project almanac</b> - Lorem ipsum dolor sit amet adipisicing elit...</td>
	            <td></td>
	            <td>20 December</td>
	          </tr>
	        </tbody>
	      </table>
	    </div>
	    <div class="text-right"><span class="text-muted mr-2">Showing 1-15 out of 60</span>
	      <div class="btn-group">
	        <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-chevron-left"></i></button>
	        <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-chevron-right"></i></button>
	      </div>
	    </div>
	  </div>
	</div>
</div>
@endsection