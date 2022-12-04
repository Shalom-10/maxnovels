<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = 'stylesheet' href = '/styles/loader.css'>
    <x-head /> <script src = '/scripts/loader.js' defer></script>

    <link rel = 'stylesheet' href = '/styles/general.css'>
    <link rel = 'stylesheet' href = '/styles/variables.css'>
    <link rel = 'stylesheet' href = '/styles/icon_btn.css'>
    <link rel = 'stylesheet' href = '/styles/btn.css'>
    <link rel = 'stylesheet' href = '/styles/login.css'>
    <link rel = 'stylesheet' href = '/styles/writeform.css'>

    <script src = '/scripts/general.js' defer></script>
    <script src = '/scripts/form_helper.js' defer></script>
</head>

<body class = 'colors pixels'>
    <x-loader></x-loader>

    <div class = 'wrapper'>

        <div class = 'left_c full-hw flex-col flex-center'>

            <div class = 'image-box flex-center flex-col bg' onclick = 'click_image();' @if($book != []) style = 'background: url("/images/cover_images/{{$book->cover_image}}");' @endif>
                <i class = 'bi bi-camera'></i>

                <span>Click to upload a cover photo</span>

                @error('cover_image')
                    <div class = 'error_message'>
                        <p>
                            {{$message}}
                        </p>
                    </div>
                @enderror
            </div>

            
        </div>

        <div class = 'right_c full-hw p-2'>
            <div class = 'top flex-row flex-between'>
                <h1>Book Details</h1>

                <div class = 'flex-row'>

                    <div class = 'btn'>
                        <span>Skip</span>
                    </div>

                    <div class = 'btn'>
                        <span>Go Back</span>
                    </div>
                </div>
            </div>

            <form method="POST" onsubmit='event.preventDefault()' enctype="multipart/form-data" action="/writeform">
                @csrf
                <div class = 'input flex-col'>
                    <label>Title</label>
                    <input type="text" name='title' placeholder="The Time Traveler's Handbook" value = '{{$book->title ?? ''}}'>
                </div>

                @error('title')
                    <div class = 'error_message'>
                        <p>
                            {{$message}}
                        </p>
                    </div>
                @enderror

                <div class = 'input flex-col'>
                    <label>Description</label>
                    <textarea name = 'description' placeholder="INtriGuing DescRipTion Of youR BooK" value = '{{$book->description ?? ''}}'>{{$book->description ?? ''}}</textarea>
                </div>

                @error('description')
                    <div class = 'error_message'>
                        <p>
                            {{$message}}
                        </p>
                    </div>
                @enderror

                <div class = 'input flex-col add' name ='main_characters'>
                    <label>Main Characters</label>

                    <div class = 'add p-rel flex-row'>
                        <input type="text" name='password' placeholder="Alexander Gustavorand" onkeyup="add_list(event);">
                        <div class = 'add-btn flex-center' onclick = 'list_creator(this);'>
                            <i class = 'bi bi-plus'></i>
                        </div>
                    </div>

                    @error('main_characters')
                        <div class = 'error_message'>
                            <p>
                                {{$message}}
                            </p>
                        </div>
                    @enderror

                    <div class = 'add-list'>
                        <input class = 'first_input' type = 'hidden' name = 'main_characters' value = ''>
                        @if ($book != [])

                            @foreach ($book->characters as $character)
                                <div class = 'add-item flex-row'>
                                    <div class = 'item'>
                                        {{$character->name}}
                                    </div>
                                    <div class = 'icon flex-center round' onclick = 'remove_list_item(this)'>
                                        <i class = 'bi bi-dash'></i>
                                    </div>
                        
                                    <input type='hidden' name = 'main_characters' value = '{{$character->name}}' >
                                </div>
                            @endforeach
                            
                        @endif
                    </div>
                
                </div>

                

                <div class = 'input flex-col'>
                    <label>Categories</label>
                    <select name = 'category' @if($book != [])value = '{{$book->category_id ?? ''}}'@endif>
                        @foreach ($categories as $category)
                            <option value='{{$category->id}}'>{{$category->name}}</option>
                        @endforeach
                        
                    </select>
                    @error('category')
                        <div class = 'error_message'>
                            <p>
                                {{$message}}
                            </p>
                        </div>
                    @enderror
                </div>

                <div class = 'input flex-col add' name = 'tags'>
                    <label>Tag</label>

                    <div class = 'add p-rel flex-row'>
                        <input type="text" name='password' placeholder="action" onkeyup="add_list(event, true);">
                        <div class = 'add-btn flex-center' onclick = 'list_creator(this);'>
                            <i class = 'bi bi-plus'></i>
                        </div>
                    </div>

                    @error('tags')
                        <div class = 'error_message'>
                            <p>
                                {{$message}}
                            </p>
                        </div>
                    @enderror

                    <div class = 'add-list'>
                        <input class = 'first_input' type = 'hidden' name = 'tags' value = ''>
                        @if ($book != [])

                            @foreach ($book->tags as $tag)
                                @if($tag != '')
                                <div class = 'add-item flex-row'>
                                    <div class = 'item'>
                                        {{$tag->name}}
                                    </div>
                                    <div class = 'icon flex-center round' onclick = 'remove_list_item(this)'>
                                        <i class = 'bi bi-dash'></i>
                                    </div>
                        
                                    <input type='hidden' name = 'tags' value = '{{$tag->name}}' >
                                </div>
                                @endif
                            @endforeach
                            
                        @endif
                    </div>
                </div>

                <div class = 'input flex-col'>
                    <label>Target Audience</label>
                    <select name = 'target_audience' @if($book != [])value = '{{$book->audience->first()->id ?? ''}}'@endif>
                        @foreach ($audiences as $audience)
                            <option value='{{$audience->id}}'>{{$audience->audience}}</option>
                        @endforeach
                    </select>

                    @error('target_audience')
                        <div class = 'error_message'>
                            <p>
                                {{$message}}
                            </p>
                        </div>
                    @enderror
                </div>

                <div class = 'input flex-col'>
                    <label>Language</label>
                    <input type="text" name='language' placeholder="English" 
                    value = '@if ($book != [])@foreach($book->languages as $language){{ $language->name }} @if($loop->last == false),@endif @endforeach @else English @endif'
                    >
                </div>

                @error('language')
                    <div class = 'error_message'>
                        <p>
                            {{$message}}
                        </p>
                    </div>
                @enderror

                <div class = 'input flex-col'>
                    <label>Copyright</label>
                    <select name = 'copyright' @if($book != [])value = '{{$book->copyright->first()->id ?? ''}}'@endif>
                        @foreach ($copyrights as $copyright)
                            <option value='{{$copyright->id}}'>{{$copyright->name}}</option>
                        @endforeach
                    </select>

                    @error('copyright')
                        <div class = 'error_message'>
                            <p>
                                {{$message}}
                            </p>
                        </div>
                    @enderror
                </div>

                <div class = 'input flex-col'>
                    <label>Rating</label>
                    <select name = 'rating' @if($book != [])value = '{{$book->rating->first()->id ?? ''}}'@endif>
                        @foreach ($ratings as $rating)
                            <option value='{{$rating->id}}'>{{$rating->name}}</option>
                        @endforeach
                    </select>

                    @error('rating')
                        <div class = 'error_message'>
                            <p>
                                {{$message}}
                            </p>
                        </div>
                    @enderror
                </div>

                <div class = 'input flex-col add' name = 'author'>
                    <label>Authors</label>

                    <div class = 'add p-rel flex-row'>
                        <input type="text" name='password' placeholder="action" onkeyup="add_list(event);">
                        <div class = 'add-btn flex-center' onclick = 'list_creator(this);'>
                            <i class = 'bi bi-plus'></i>
                        </div>
                    </div>

                    @error('author')
                        <div class = 'error_message'>
                            <p>
                                {{$message}}
                            </p>
                        </div>
                    @enderror

                    <div class = 'add-list'>
                        <input class = 'first_input' type = 'hidden' name = 'author' value = ''>
                        @if ($book != [])
                            
                            <?php $authors = explode(',', $book->authors); ?>
                            
                            @foreach ($authors as $author)
                                @if($author != '')
                                <div class = 'add-item flex-row'>
                                    <div class = 'item'>
                                        {{$author}}
                                    </div>
                                    <div class = 'icon flex-center round' onclick = 'remove_list_item(this)'>
                                        <i class = 'bi bi-dash'></i>
                                    </div>
                        
                                    <input type='hidden' name = 'author' value = '{{$author}}' >
                                </div>
                                @endif
                            @endforeach

                        @else

                        @endif
                    </div>
                </div>

                @if ($type == 'external')
                    <div class = 'input flex-col'>
                        <label>Book File</label>
                        <p style = 'font-family: "Poppins", sans-serif; padding-bottom: .5rem; font-size: 70%; font-weight: 400;'>
                            pdf or doc extension documents only
                        </p>
                        <input type='file' accept=".doc, .docx, .pdf" name='book_file' >
                    </div>

                    @error('book_file')
                        <div class = 'error_message'>
                            <p>
                                {{$message}}
                            </p>
                        </div>
                    @enderror

                    <input name = 'type' type = 'hidden' value = 'external'>
                @else 
                    <input name = 'type' type = 'hidden' value = 'native'>
                    
                @endif

                <input type='file' accept="image/*" name='cover_image' style = 'visibility: hidden;' onchange = 'previewImage(event);'>


                @if ($book != [])
                    <input type = 'hidden' name = 'id' value = {{$book->id}} >
                @else
                    <input type = 'hidden' name = 'id'>
                @endif

                <div class = 'input flex-row flex-end'>
                    <div class = 'submit' onclick = "form_submit(this);">
                        Start writing
                    </div>
                </div>

            </form>

        </div>

    </div>
</body>

</html>