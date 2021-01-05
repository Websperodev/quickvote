<div class="cta py-5">
    <div class="container">
    <div class="row vcenter">
      <div class="col-md-7">
      <h2 class="titleh2">{!! isset($pageData['news and update']['heading1']) ? ucfirst($pageData['news and update']['heading1']) : 'News and Updates' !!} </h2>
      <p>{!! isset($pageData['news and update']['description']) ? ucfirst($pageData['news and update']['description']) : 'Subscribe to our newsletter and receive the latest news from QuickVote.' !!}</p>
      </div>
      <div class="col-md-5">
      <form class="subs">
        <div class="form-group">
        <input type="text" class="form-control" name="newsletter" placeholder="Enter Your Email">
        <button type="submit" class="btn btn-primary nletter">Subscribe</button>
        </div>      
      </form>
      </div>
    </div>
    </div>
  </div>
  