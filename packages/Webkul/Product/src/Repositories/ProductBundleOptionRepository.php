<?php

namespace Webkul\Product\Repositories;

use Illuminate\Container\Container;
use Illuminate\Support\Str;
use Webkul\Core\Eloquent\Repository;
use Webkul\Product\Contracts\ProductBundleOption;

class ProductBundleOptionRepository extends Repository
{
    /**
     * Create a new repository instance.
     *
     * @return void
     */
    public function __construct(
        protected ProductBundleOptionProductRepository $productBundleOptionProductRepository,
        Container $container
    ) {
        parent::__construct($container);
    }

    /**
     * Specify model class name.
     */
    public function model(): string
    {
        return ProductBundleOption::class;
    }

    /**
     * Save bundle options.
     *
     * @param  array  $data
     * @param  \Webkul\Product\Contracts\Product  $product
     * @return void
     */
    public function saveBundleOptions($data, $product)
    {
        $previousBundleOptionIds = $product->bundle_options()->pluck('id');

        if (isset($data['bundle_options'])) {
            foreach ($data['bundle_options'] as $bundleOptionId => $bundleOptionInputs) {
                if (Str::contains($bundleOptionId, 'option_')) {
                    $productBundleOption = $this->create(array_merge([
                        'product_id' => $product->id,
                    ], $bundleOptionInputs));
                } else {
                    $productBundleOption = $this->find($bundleOptionId);

                    if (is_numeric($index = $previousBundleOptionIds->search($bundleOptionId))) {
                        $previousBundleOptionIds->forget($index);
                    }

                    $this->update($bundleOptionInputs, $bundleOptionId);
                }

                $this->productBundleOptionProductRepository->saveBundleOptionProducts($bundleOptionInputs, $productBundleOption);
            }
        }

        foreach ($previousBundleOptionIds as $previousBundleOptionId) {
            $this->delete($previousBundleOptionId);
        }
    }
}
