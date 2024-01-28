<div class="bg-white px-4 pb-4"
    style="width: 100vw;max-width: 32rem;@media (min-width: 640px) {padding: 1.5rem; padding-bottom: 1rem;}">
    <div class="d-flex align-items-center">
        <div class="mx-auto  d-flex align-items-center justify-content-center  bg-danger"
            style="flex-shrink: 0;height: 3rem;width: 3rem; border-radius: 9999px; @media (min-width: 640px) {
                margin-left: 0;
              margin-right: 0;
              width: 2.5rem;
              height: 2.5rem;
               }">
            <!-- Heroicon name: outline/exclamation -->
            <svg class="text-danger" style="width: 1.5rem;height: 1.5rem; " xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>
        <div class="mt-3 text-center"
            style="@media (min-width: 640px) {margin-top: 0;margin-left: 1rem;text-align: left;}">
            <h3 style="color: #111827;font-size: 1.125rem;line-height: 1.75rem;font-weight: 500;line-height: 1.5rem; "
                id="modal-title">Delete Record
            </h3>
            <div class="mt-2">
                <p style="color: #6B7280;font-size: 0.875rem;line-height: 1.25rem; ">
                    Are you sure you want to delete record? All of data will be permanently
                    deleted. This action cannot be undone.
                </p>
            </div>
        </div>
    </div>
</div>
<div class="px-4 py-3"
    style="background-color: #F9FAFB;  @media (min-width: 640px) {display: flex;padding-left: 1.5rem;padding-right: 1.5rem;flex-direction: row-reverse;}">
    <button type="button" onclick="deleteMul(this)" data-url="{{ $data['url'] }}" data-method="{{ $data['type'] }}"
        data-target="commonModal" class="justify-content-center"
        style="display: inline-flex;
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
        padding-left: 1rem;
        padding-right: 1rem;
        background-color: #DC2626;
        color: #ffffff;
        font-size: 1rem;
        line-height: 1.5rem;
        font-weight: 500;
        width: 100%;
        border-radius: 0.375rem;
        border-width: 1px;
        border-color: transparent;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);

        @media (min-width: 640px) {
          margin-left: 0.75rem;
        font-size: 0.875rem;
        line-height: 1.25rem;
        width: auto;
         }
:hover {
         background-color: #B91C1C;
         }">
        Delete
    </button>
    <button type="button" data-dismiss="modal" onclick="hideDiv(this)"
        class="mt-3  justify-content-center  px-4 py-2 bg-white"
        style="display: inline-flex;
        color: #374151;
        font-size: 1rem;
        line-height: 1.5rem;
        font-weight: 500;
        width: 100%;
        border-radius: 0.375rem;
        border-width: 1px;
        border-color: #D1D5DB;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);

        @media (min-width: 640px) {
          margin-top: 0;
        font-size: 0.875rem;
        line-height: 1.25rem;
        width: auto;
         }




        :hover {
         background-color: #F9FAFB;
         }">
        Cancel
    </button>
</div>
