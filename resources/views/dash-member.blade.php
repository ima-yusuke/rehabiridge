<x-app-layout>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    氏名
                </th>
                <th scope="col" class="px-6 py-3">
                    メールアドレス
                </th>
                <th scope="col" class="px-6 py-3">
                    会員権限
                </th>
            </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                           {{$user["id"]}}
                        </th>
                        <td class="px-6 py-4">
                            {{$user["name"]}}
                        </td>
                        <td class="px-6 py-4">
                            {{$user["email"]}}
                        </td>
                        <td class="px-6 py-4">
                            <label class="inline-flex items-center cursor-pointer mr-4">
                                <span class="ms-3 text-xs md:text-sm font-medium text-gray-900 dark:text-gray-300 mr-2">無効</span>
                                <input type="checkbox" value="{{$user['id']}}" class="toggleBtn sr-only peer" @if($user->hasRole('member')) checked @endif>
                                <div class="relative w-7 h-4 sm:w-11 sm:h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-3 after:w-3 sm:after:h-5 sm:after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                <span class="ms-3 text-xs md:text-sm font-medium text-gray-900 dark:text-gray-300">有効</span>
                            </label>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @vite(['resources/js/admin/dash-member.js'])
</x-app-layout>
