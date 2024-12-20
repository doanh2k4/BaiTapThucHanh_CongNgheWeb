<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Cập nhật thông tin</title>
</head>

<body>

    <h1 style="margin: 50px 50px">Cập nhật thông tin</h1>

    <form action="{{ route('issues.update', $issue->id) }}" method="POST" style="margin: 50px 50px">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="computer_name" class="form-label">Tên máy tính</label>
            <input type="text" class="form-control" id="computer_name" name="computer_name" value="{{ $issue->computer->computer_name }}" required>
        </div>
        <div class="mb-3">
            <label for="model" class="form-label">Tên phiên bản</label>
            <input type="text" class="form-control" id="model" name="model" value="{{ $issue->computer->model }}" required>
        </div>
        <div class="mb-3">
            <label for="reported_by" class="form-label">Người báo cáo sự cố</label>
            <input type="text" class="form-control" id="reported_by" name="reported_by" value="{{ $issue->reported_by }}" required>
        </div>
        <div class="mb-3">
            <label for="reported_date" class="form-label">Thời gian báo cáo</label>
            <input type="date" class="form-control" id="reported_date" name="reported_date" value="{{ $issue->reported_date }}" required>
        </div>
        <div class="mb-3">
            <label for="urgency" class="form-label">Mức độ sự cố</label>
            <input type="text" class="form-control" id="urgency" name="urgency" value="{{ $issue->urgency }}" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <input type="text" class="form-control" id="status" name="status" value="{{ $issue->status }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>

</body>

</html>
