<?php

namespace App\Traits\Providers;

trait ServiceProviderTrait
{
    /**
     * Create an action instance with optional dependencies.
     * @param string $implementation
     * @return mixed|object|string|null
     */
    private function makeAction(string $implementation): mixed
    {
        try {
            $reflection = new \ReflectionClass($implementation);

            if ($reflection->getConstructor()) {
                $dependencies = $this->resolveDependencies($reflection->getConstructor()->getParameters());

                return $reflection->newInstanceArgs($dependencies);
            }

            return new $implementation();
        } catch (\ReflectionException $e) {
            return null;
        }
    }

    /**
     * Resolve dependencies for an action constructor.
     * @param array $parameters
     * @return array
     */
    private function resolveDependencies(array $parameters): array
    {
        $dependencies = [];

        foreach ($parameters as $parameter) {
            try {
                $dependencies[] = $this->app->make($parameter->getType()->getName());
            } catch (\Exception $e) {

            }
        }

        return $dependencies;
    }

    /**
     * Bind a support class to its contract.
     *
     * @param string $alias
     * @param string $contract
     * @return void
     */
    private function bindSupport(string $alias, string $contract): void
    {
        $this->app->bind($alias, function () use ($contract) {
            return $this->app->make($contract);
        });
    }
}
