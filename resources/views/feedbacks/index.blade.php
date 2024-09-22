<x-app-dashboard name="Feedback List" icon="comment-alt">
    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead class="theadf-dark">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Comment</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)
                    <tr>
                        <td class="text-capitalize">{{ $comment->name }}</td>
                        <td class="text-capitalize">{{ $comment->email }}</td>
                        <td class="text-capitalize">{{ $comment->comment }}</td>
                        <td class="text-capitalize">{{ $comment->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $comments->links() }}
        </div>
    </div>
</x-app-dashboard>
