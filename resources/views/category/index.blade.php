@extends("layouts.master")
@section('title') BikeShop | รายการประเภทสินค้า @stop
@section('content')
    <div class="container">
        <table class="table table-bordered bs-table">
            <thead>
                <tr>
                    <th>รหัส</th>
                    <th>ชื่อประเภทสินค้า </th>
                    <th>สร้างเมื่อ</th>
                    <th>อัปเดตเมื่อ</th>
                    <th>การทำงาน</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($categorys as $c)
                    <tr>
                        <td>{{ $c->id }}</td>
                        <td>{{ $c->name }}</td>
                        <td>{{ $c->created_at }}</td>
                        <td>{{ $c->update_at }}</td>
                        <td class="bs-center">
                            <!--หลังจากโปรแกรมแสดงข้อมูลออกมาได้แล้ว จึงค่อยเขียน link แก้ไข ลบ-->
                            <a href="#" class="btn btn-info"><i class="fa fa-edit"></i> แก้ไข</a>
                            <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i> ลบ</a>
                        </td>

                    </tr>
                @endforeach
            </tbody> 
        </table>
    </div>
@endsection
