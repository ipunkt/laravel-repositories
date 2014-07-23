# Generic repository implementation for Laravel 4.x
[![Latest Stable Version](https://poser.pugx.org/ipunkt/laravel-repositories/v/stable.svg)](https://packagist.org/packages/ipunkt/laravel-repositories) [![Latest Unstable Version](https://poser.pugx.org/ipunkt/laravel-repositories/v/unstable.svg)](https://packagist.org/packages/ipunkt/laravel-repositories) [![License](https://poser.pugx.org/ipunkt/laravel-repositories/license.svg)](https://packagist.org/packages/ipunkt/laravel-repositories) [![Total Downloads](https://poser.pugx.org/ipunkt/laravel-repositories/downloads.svg)](https://packagist.org/packages/ipunkt/laravel-repositories)

## Installation

Add to your composer.json following lines

	"require": {
		"ipunkt/laravel-repositories": "~1.0"
	}


## Usage

### Repository Interfaces

Simply extend your interfaces by the provided interface `Ipunkt\LaravelRepositories\Contracts\RepositoryInterface`.

#### Example

	use Ipunkt\LaravelRepositories\Contracts\RepositoryInterface;

	interface HolidayRepository extends RepositoryInterface
	{
		public function allByUser(User $user);
	}


### Repository Classes

Simply extend your repository class by the provided `Ipunkt\LaravelRepositories\EloquentRepository`. It is an abstract class.

You need to have your own constructor which sets the internal property `model` to the appropriate model this repository will work on.

#### Example

	use Ipunkt\LaravelRepositories\EloquentRepository;

	class EloquentHolidayRepository extends EloquentRepository implements HolidayRepository
	{
		/**
		 * @param Holiday $holiday eloquent model
		 */
		public function __construct(Holiday $holiday)
		{
			$this->model = $holiday;
		}

		/** implementing all methods in HolidayRepository */
	}


### Registering with an Service Provider

You should register all repository stuff with a service provider to use it for example in a controller.

#### Example

	class RepositoryServiceProvider extends ServiceProvider
	{
		public function register()
		{
			//  binding interface HolidayRepository to the concrete implementation of EloquentHolidayRepository
			$this->app->bind(
				'HolidayRepository',
				function () {
					return new EloquentHolidayRepository(new Holiday());
				}
			);
		}
	}


	class HolidayController extends Controller
	{
		private $repo;

		public function __construct(HolidayRepository $holidayRepository)
		{
			$this->repo = $holidayRepository;
		}
	}



## API Documentation

Please look at the `Ipunkt\LaravelRepositories\Contracts\RepositoryInterface` for the current existing methods.

