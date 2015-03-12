@servers(['web-1' => '192.168.1.1', 'web-2' => '192.168.1.2'])


@setup()
	$now = new DateTime();

	$environment = isset($env) ? $env : "testing";
@endsetup


@macro('deploy')
	A
	B
@endmacro


@task('A', ['on' => ['web-1', 'web-2']], 'parallel' => true)
	echo 'HELLO'
@endtask


@task('B', ['on' => ['web-1', 'web-2']], 'parallel' => true)
	echo 'WORLD'
@endtask


@after
	@slack('team', 'token', 'channel')
@endafter


@after
	@hipchat('token', 'room', 'Envoy', "Tasks ran on [$environment]")
@endafter
