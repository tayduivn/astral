<div class="ui tab segment" data-tab="announcements">

  @include('admin.announcements._form')

  @if ($announcements->count() > 0)
    <table class="ui very basic striped selectable celled table">
    <thead>
      <tr>
        <th>Title</th>
        <th>Type</th>
        <th>Start</th>
        <th>End</th>
        <th>Status</th>
        <th>Created by</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($announcements as $announcement)
        <tr>
          <td>
            <h4 class="ui header">
              <i class="announcement icon"></i>
              {{ $announcement->title }}
              ({{ $announcement->public ? "Public" : "Private" }})
            </h4>
          </td>
          <td>
            <div class="ui {{ $announcement->type }} label">
              {{ $announcement->type }}
            </div>
          </td>
          <td>
            {{ $announcement->start->format('l, F j, Y \a\t g:i A') }}
          </td>
          <td>
            {{ $announcement->end->format('l, F j, Y \a\t g:i A') }}
          </td>
          <td>
            <div class="ui black label">
            {{ $announcement->end->isPast() ? "expired" : null }}
            {{ $announcement->end->isFuture() ? "active" : null }}
            </div>
          </td>
          <td>
            <i class="user circle icon"></i> {{ $announcement->creator->firstname }}
          </td>
          <td>
            <div class="ui tiny buttons">
              @if(str_contains(Auth::user()->role->permissions['settings'], 'U'))
                <a href="{{ route('admin.announcements.edit', $announcement) }}" class="ui icon yellow button"><i class="edit icon"></i></a>
              @endif
              @if(str_contains(Auth::user()->role->permissions['settings'], 'D'))
                <form action="{{ route('admin.announcements.destroy', $announcement) }}" method="POST">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <button type="submit" class="ui icon red button"><i class="trash icon"></i></a>
                </form>
              @endif
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  @else
    <br><br>
    <div class="ui info icon message">
        <i class="info circle icon"></i>
        <i class="close icon"></i>
        <div class="content">
          <div class="header">
            No announcements!
          </div>
          <p>It looks like you have not set up any announcements yet.</p>
        </div>
      </div>
  @endif
</div>
