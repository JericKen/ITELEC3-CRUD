<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-data-tab" data-bs-toggle="tab" data-bs-target="#nav-data" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Data</button>
                <button class="nav-link" id="nav-data-entry-tab" data-bs-toggle="tab" data-bs-target="#nav-data-entry" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Data entry</button>
            </div>
        </nav>
        <div class="tab-content p-4" id="nav-tabContent">

            <div class="tab-pane fade show active" id="nav-data" role="tabpanel" aria-labelledby="nav-data-tab" tabindex="0">
                <h3>Data</h3>
                <div class="responsive-table">
                    <table class="table table-hover">
                        <thead>
                            <tr><th>ID</th><th>Title</th><th>Content</th><th width="20%"></th></tr>
                        </thead>
                        <tbody id="tbody" class="table-group-divider">
                            
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-data-entry" role="tabpanel" aria-labelledby="nav-data-entry-tab" tabindex="0">
                
                <form action="" method="" id="formData" class="w-50">
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="title" class="label-control">Title</label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="content" class="label-control">Content</label>
                        <textarea name="content" id="content" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success w-50">Submit</button>
                </form>
            </div>

        </div>
    </div>
   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="about.js"></script>
</body>
</html>