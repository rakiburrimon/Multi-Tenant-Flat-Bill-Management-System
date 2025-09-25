<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BillController extends Controller
{
    /**
     * Controller method usage
     */
    public function index(Request $request): Response
    {
        $ownerId = (int)($request->user()->id ?? 0);
        $bills = Bill::query()->forOwner($ownerId)->paginate(20);
        return response($bills);
    }

    /**
     * Controller method usage
     */
    public function show(Request $request, Bill $bill): Response
    {
        $ownerId = (int)($request->user()->id ?? 0);
        if ((int)$bill->house_owner_id !== $ownerId) {
            return response(['message' => 'Forbidden'], 403);
        }
        return response($bill);
    }

    /**
     * Controller method usage
     */
    public function store(Request $request): Response
    {
        $ownerId = (int)($request->user()->id ?? 0);
        $data = $request->validate([
            'flat_id' => ['required', 'integer', 'exists:flats,id'],
            'tenant_id' => ['nullable', 'integer', 'exists:tenants,id'],
            'category_id' => ['required', 'integer', 'exists:bill_categories,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'due_date' => ['nullable', 'date'],
            'remarks' => ['nullable', 'string', 'max:255'],
        ]);

        $bill = Bill::query()->create([
            'house_owner_id' => $ownerId,
            'flat_id' => $data['flat_id'],
            'tenant_id' => $data['tenant_id'] ?? null,
            'category_id' => $data['category_id'],
            'amount' => (float)$data['amount'],
            'due_date' => $data['due_date'] ?? null,
            'status' => 'unpaid',
            'remarks' => $data['remarks'] ?? null,
        ]);

        // TODO: dispatch email notification for bill creation

        return response($bill, 201);
    }

    /**
     * Controller method usage
     */
    public function pay(Request $request, Bill $bill): Response
    {
        $ownerId = (int)($request->user()->id ?? 0);
        if ((int)$bill->house_owner_id !== $ownerId) {
            return response(['message' => 'Forbidden'], 403);
        }

        $bill->status = 'paid';
        $bill->paid_at = (new \DateTime())->format('Y-m-d H:i:s');
        $bill->save();

        // TODO: dispatch email notification for bill payment

        return response($bill);
    }

    /**
     * Controller method usage
     */
    public function destroy(Request $request, Bill $bill): Response
    {
        $ownerId = (int)($request->user()->id ?? 0);
        if ((int)$bill->house_owner_id !== $ownerId) {
            return response(['message' => 'Forbidden'], 403);
        }
        $bill->delete();
        return response(null, 204);
    }
}


