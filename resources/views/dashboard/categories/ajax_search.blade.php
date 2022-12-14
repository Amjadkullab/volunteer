<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>اسم الفئة</th>
            <th>صورة الفئة</th>
            <th>حالة الفئة</th>
            <th>تاريخ الانشاء</th>
            <th>تاريخ التعديل</th>
            <th colspan="2">الاعدادات</th>
        </tr>
    </thead>
    <tbody>
    @php
    $i = 1;
    @endphp
        @forelse ($categories as $category)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $category->name }}</td>
                <td><img src="{{asset('uploads/' . $category->image)}}" width="100">   </td>
                <td>{{ $category->status == 'active' ? 'نشط' : 'أرشيف' }}</td>
                <td>{{ $category->created_at }}</td>
                <td>{{ $category->updated_at }}</td>
                <td>
                    <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                        class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                </td>
                <td>
                    <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button>
                    </form>
                </td>
            </tr>
        </tbody>
        @empty
            <td colspan="9">لا يوجد بيانات ..</td>
        @endforelse
</table>
