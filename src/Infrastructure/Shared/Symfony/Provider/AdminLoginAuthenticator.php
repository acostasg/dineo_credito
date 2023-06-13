<?php

namespace App\Infrastructure\Shared\Symfony\Provider;

use App\Admin\UI\AdminLoginForm;
use App\Infrastructure\Shared\Symfony\Encoder\UserPasswordEncoder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\AuthenticatorInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;


final class AdminLoginAuthenticator  extends AbstractAuthenticator implements AuthenticatorInterface
{
    private FormFactoryInterface $formFactory;

    private RouterInterface $router;

    private UserPasswordEncoder $passwordEncoder; // TODO create interface

    private UserProviderInterface $userProvider;

    public function __construct(
        FormFactoryInterface $formFactory,
        RouterInterface $router,
        UserPasswordEncoder $passwordEncoder,
        UserProviderInterface $userProvider
    ) {
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->passwordEncoder = $passwordEncoder;
        $this->userProvider = $userProvider;
    }

    public function supports(Request $request): bool
    {
        return $request->attributes->get('_route') === 'admin_login' && $request->isMethod('POST');
    }

    public function getCredentials(Request $request): array
    {
        $form = $this->formFactory->create(AdminLoginForm::class);
        $form->handleRequest($request);

        $data = $form->getData();
        $request->getSession()->set(
            Security::LAST_USERNAME,
            $data['email']
        );

        return $data;
    }

    public function checkCredentials($credentials, UserInterface $user): bool
    {
        return $this->passwordEncoder->isPasswordValid($user, $credentials['password']);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): RedirectResponse
    {
        $request->getSession()->set(Security::AUTHENTICATION_ERROR, $exception);

        return new RedirectResponse($this->router->generate('admin_login'));
    }


    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): RedirectResponse
    {
        return new RedirectResponse($this->router->generate('sonata_admin_dashboard'));
    }

    protected function getLoginUrl(Request $request): string
    {
        return $this->router->generate('admin_login');
    }

    public function authenticate(Request $request): Passport
    {
        $form = $this->formFactory->create(AdminLoginForm::class);
        $form->handleRequest($request);

        $data = $form->getData();
        $request->getSession()->set(
            Security::LAST_USERNAME,
            $data['email']
        );

        $user = $this->userProvider->loadUserByUsername($data['email']);

        if (!$this->checkCredentials($data, $user)){
            throw new AuthenticationException('Invalid credentials.');
        }

        return new Passport(
            new UserBadge( $data['email'], function (string $email, UserInterface $user) {
                return $user;
            }),
            $data
        );
    }
}