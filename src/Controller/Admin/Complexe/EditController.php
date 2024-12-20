<?php

declare(strict_types=1);

namespace App\Controller\Admin\Complexe;

use App\Service\Complex\Complex;
use App\Service\Complex\ComplexRepository;
use Gigamel\Frontend\View\RenderCompositeInterface;
use Gigamel\Form\Field\InputText;
use Gigamel\Form\Field\Textarea;
use Gigamel\Form\Form;
use Gigamel\Form\FormInterface;
use Gigamel\Http\HttpException;
use Gigamel\Http\Protocol\ClientMessage\Method;
use Gigamel\Http\Protocol\ClientMessageInterface;
use Gigamel\Http\Protocol\ServerMessageInterface;
use Gigamel\Http\ServerMessage;

final class EditController
{
    public function __construct(
        private readonly ComplexRepository $repository,
        private readonly RenderCompositeInterface $renderComposite
    ) {
    }

    public function __invoke(ClientMessageInterface $message): ServerMessageInterface
    {
        $complex = $this->repository->getById($message->getSegment('id'));
        if (!$complex) {
            throw new HttpException('Page Not Found', 404);
        }

        $form = $this->buildForm($complex);

        if ($form->handle($message)) {
            $complex->title = $_POST['title'];
            $complex->description = $_POST['description'];

            if ($this->repository->save($complex)) {
                return new ServerMessage('Success', 302, ['Location' => $message->getPath()]);
            }
        }

        return new ServerMessage(
            $this->renderComposite->render(
                'admin.php',
                [
                    'content' => $form->render(
                        __DIR__ . '/../../../../view/complex/form.htmlx',
                        [
                            'complex' => $complex,
                        ]
                    ),
                ]
            )
        );
//         return new ServerMessage(
//             $this->renderComposite->render(
//                 'admin.php',
//                 [
//                     'content' => $this->renderComposite->render(
//                         'complex/form.php',
//                         [
//                             'complex' => $complex,
//                         ]
//                     ),
//                 ]
//             )
//         );
    }

    private function buildForm(Complex $complex): FormInterface
    {
        $titleField = new InputText(
            'title',
            [
                'class' => 'form-control',
                'placeholder' => 'Title',
            ]
        );
        $titleField->setValue($complex->title);

        $descriptionField = new Textarea(
            'description',
            [
                'class' => 'form-control',
                'placeholder' => 'Description',
            ]
        );
        $descriptionField->setValue($complex->description);

        return (new Form(Method::POST))
            ->field($titleField)
            ->field($descriptionField);
    }
}
