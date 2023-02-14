<?php
// https://github.com/filamentphp/filament/discussions/876
// https://www.iankumu.com/blog/laravel-many-to-many-relationship/
namespace App\Http\Livewire\Video;

use Session;
use App\Models\Assets\Video;

use App\Models\Assets\VideoTag;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

use Livewire\Component;

class EditVideo extends Component implements HasForms
{
    use InteractsWithForms;

    public Video $video;
    public string $viewUrl;

    // ==== FIELDS ====
    public $title = '';
    public $description = '';
    public $date = '';
    public $tagIds = [];
    public $vimeoUrl = '';
    public $chatUrl = '';

    protected function getFormSchema(): array
    {
        return [
            Section::make('Edit Video')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            DatePicker::make('date')
                                ->label('Date')
                                ->required()
                                ->displayFormat('Y-m-d'),
                        ]),
                    TextInput::make('title')
                        ->label('Title')
                        ->required(),
                    Select::make('tagIds')
                        ->multiple()
                        ->label('Tags')
                        ->options(VideoTag::all()->sortBy('name')->pluck('name', 'id'))
                        ->searchable(),
//                    CheckboxList::make('tagIds')
//                        ->options(VideoTag::all()
//                            ->sortBy('name')
//                            ->pluck('name', 'id'))
//                            ->columns(2),
                    Textarea::make('description')->label('Description'),
                    TextInput::make('vimeoUrl')
                        ->label('Vimeo Url')
                        ->required(),
                    TextInput::make('chatUrl')
                        ->label('Chat Url'),
                ])
        ];

    }

    public function mount()
    {
        $this->form->fill(
            [
                'date' => $this->video->webinar_date,
                'title' => $this->video->title,
                'description' => $this->video->description,
                'vimeoUrl' => $this->video->vimeo_url,
                'chatUrl' => $this->video->chat_url,
                'test' => 2,
                 'tagsIds' => $this->video->tags->pluck('id')->toArray()
            ]
        );
        $this->isAdminUser = true;
        $this->viewUrl = route('view.video', ['video' => $this->video->id]);;
    }

    public function render()
    {
        return view('livewire.video.edit-video')
            ->layout('layouts.admin.livewire', ['title' => 'Video > Dashboard > Edit Video']);
    }

    public function save()
    {
        // === update the video ===
        $formState = $this->form->getState();
        $fields = [
            'title' => 'title',
            'description' => 'description',
            'date' => 'webinar_date',
            'vimeoUrl' => 'vimeo_url',
            'chatUrl' => 'chat_url'
        ];
        $updateArray = [];
        foreach ($fields as $formField => $field) {
            if (isset($formState[$formField])) {
                $updateArray[$field] = $formState[$formField];
            }
        }
        $this->video->update($updateArray);
        $tagIds  = $formState['tagIds'];
        $this->video->tags()->sync($tagIds);
    }
}
