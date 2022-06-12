<div class="form-group">
    <label for="category_id">Category Level</label>
    <select name="category_id" id="category_id" class=" custom-select">
      <option value="0">Main Category</option>
     @if (!empty($getcategories))
         @foreach($getcategories as $mcategory)
            <option value="{{$mcategory->id}}" @if(isset($category) && $category->parent_id==$mcategory->id) selected @endif> {{$mcategory->name}}</option>

            @if(!empty($mcategory->subcategories)){
                @foreach($mcategory->subcategories as $scategory)
                     <option value="{{$scategory->id}}">&nbsp; &raquo; &nbsp; {{$scategory->name}}</option>
                @endforeach
               
            }
            @endif
         @endforeach
           
     @endif
    </select>
</div>