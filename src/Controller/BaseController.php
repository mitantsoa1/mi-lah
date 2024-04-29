<?php


namespace App\Controller;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Vich\UploaderBundle\Mapping\PropertyMappingFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

abstract class BaseController extends AbstractController
{
    /**
     * @var ContainerInterface
     */
    //   protected $container;
    protected $parameter;
    protected $serializer;
    protected $entityManager;
    protected $passwordEncoder;
    protected $propertyMappingFactory;

    /**
     * BaseController constructor.
     * @param SerializerInterface $serializer
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param PropertyMappingFactory $propertyMappingFactory
     * @param ContainerInterface $container , 
     */
    public function __construct(
        SerializerInterface $serializer,
        // UserPasswordEncoderInterface $passwordEncoder,
        // PropertyMappingFactory $propertyMappingFactory , 
        EntityManagerInterface $entityManager,
        // ContainerInterface $container ,
        ParameterBagInterface $parameter
    ) {
        $this->serializer = $serializer;
        // $this->container        = $container;
        $this->parameter        = $parameter;
        $this->entityManager    = $entityManager;
        // $this->passwordEncoder = $passwordEncoder;
        // $this->propertyMappingFactory = $propertyMappingFactory;
    }


    /**
     * @param string|null $name
     * @return EntityManagerInterface
     */
    public function getRepository($entity): EntityRepository
    {
        return $this->entityManager->getRepository($entity);
    }

    /**
     * Gets the parameter value for the given name from Container
     *
     * @param string $name The parameter
     * 
     * @return mixed The parameter value
     * 
     * @throws InvalidArgumentException if the parameter is not defined
     */
    // public function getParameter(string $name)
    // {
    //     return $this->parameter->get($name);
    // }

    /**
     * Gets the service class for the given id from Container
     *
     * @param string $id The service Id
     * 
     * @return mixed The service class
     * 
     * @throws InvalidArgumentException if the service is not defined
     */
    public function getService(string $id)
    {
        return $this->container->get($id);
    }

    /**
     * Saves given object using the default entity manager
     *
     * @param object $object The object to save
     * @return object The saved object, throws otherwise
     * @throws ORMException if an error has occurred
     */
    public function save($object)
    {

        $em = $this->entityManager;

        try {

            if ($object->getId() === null) {


                $em->persist($object);
            }

            $em->flush();

            return $object;
        } catch (ORMException $ORMex) {
            throw $ORMex;
        }
    }

    public function persist($object)
    {

        $em = $this->entityManager;

        try {

            $em->persist($object);
        } catch (ORMException $ORMex) {
            throw $ORMex;
        }
    }

    public function flush()
    {

        $em = $this->entityManager;

        $em->flush();
    }

    /**
     * @param mixed $data
     * @param string $type
     * @return string
     */
    public function serialize($data, string $type, $context = [])
    {
        return $this->serializer->serialize($data, $type, $context);
    }


    public function jsonResponseNotFound($message)
    {
        # code...
        return new JsonResponse([

            "data"      => [],
            "code"      => Response::HTTP_NOT_FOUND,
            "success"   => false,
            "message"   => $message

        ]);
    }

    /**
     * Removes given object using the default entity manager
     *
     * @param object $object The object to save
     * @return bool True if object was successfuly removed, throws otherwise
     * @throws ORMException if an error has occurred
     */
    public function remove($object)
    {
        $em = $this->entityManager;

        try {
            $em->remove($object);
            $em->flush();

            return true;
        } catch (ORMException $ORMex) {
            throw $ORMex;
        }
    }


    public function flashRedirect($type, $message, $route)
    {
        $this->addFlash($type, $message);

        return $this->redirectToRoute($route, []);
    }

    public function redirectRoute($route)
    {
        return $this->redirectToRoute($route);
    }

    public function getUrlServer()
    {
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            $url = "https";
        } else {
            $url = "http";
        }

        $url .= "://";
        $url .= $_SERVER['HTTP_HOST'];
        // $url .= $_SERVER['REQUEST_URI']; 

        return $url;

        // $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }

    public function uploadFile($files, $parameter, $path)
    {
        $datas = [];
        if ($files != null) {
            $file       = explode('.', $files->getClientOriginalName());
            $datas['filename']   = $file[0] . '' . uniqid() . '.' . $files->guessExtension();
            $datas['path']       = $this->getUrlServer() . $path . "/" . $datas['filename'];

            $files->move($this->getParameter($parameter), $datas['filename']);
        }

        return $datas;
    }

    public function removeFile($files, $parameter)
    {
        # code...
        $filesystem = new Filesystem();

        $filename = $this->getParameter($parameter) . '/' . $files;

        return $filesystem->remove($filename);
    }
}
