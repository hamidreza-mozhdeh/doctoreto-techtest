<?php

namespace App\Http\Controllers;

use App\Http\Requests\WalletRequest;
use App\Http\Resources\WalletResource;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{

    /**
     * Deposit Wallet.
     *
     * @OA\Post(
     *     path="/api/wallets",
     *     tags={"Wallets"},
     *     security={{"passport": {}}},
     *     operationId="DepositWallet",
     *     description="Deposit Wallet.",
     * @OA\RequestBody(
     *         description="Code to add",
     *         required=true,
     * @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     * @OA\Schema(ref="#/components/schemas/WalletRequest")
     *         )
     *     ),
     * @OA\Response(
     *         response=201,
     *         description="Wallet response",
     * @OA\JsonContent(ref="#/components/schemas/Wallet")
     *     )
     * )
     *
     * @param WalletRequest $request Request.
     *
     * @return WalletResource
     */
    public function deposit(WalletRequest $request): WalletResource
    {
        $user = User::find($request->get('user_id'));
        $wallet = $user->deposit($request->get('deposit'));
        return new WalletResource($wallet);
    }

}
